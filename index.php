<?php

class TestProject
{

    public function __construct()
    {
        $this->include();
    }

    public function include()
    {
        require __DIR__ . '/vendor/autoload.php';
        include "connection.php";
    }

    public function go()
    {
        $conn = new connection();

        if ($conn->is_connected()) {
            require_once("gmail.php");
            $gmail = new gmail($conn->get_client());
            return $gmail->listMessages();
        } else {
            return $conn->get_unauthenticated_data();
        }
    }
}


$testObj = new TestProject();
echo "<!DOCTYPE html><html>";
$out =  $testObj->go();

foreach($out as $disp){
    echo $disp;
}
echo "</html>";
