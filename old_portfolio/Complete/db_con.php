<?php

$servername = "jerry.maviccloud.com";
$username = "akashshar985";
$password = "9Akashshar985@#";
$dbname = "test";

mysqli_report(MYSQLI_REPORT_STRICT);
try{
    $con = new mysqli($servername,$username,$password,$dbname);
    date_default_timezone_set('Asia/Kolkata');
// echo "Success";
}catch(Exception $ex){
echo "Something went wrong".$ex->getMessage();
exit();
}

?>