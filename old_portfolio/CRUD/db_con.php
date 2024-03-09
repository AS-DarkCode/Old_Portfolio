<?php

$servername = 'jerry.maviccloud.com';
$username = 'akashshar985';
$password = '9Akashshar985@#';
$db = 'if0_35781118_cms';

mysqli_report(MYSQLI_REPORT_STRICT);
try {
    $con = new mysqli($servername, $username, $password, $db);
    date_default_timezone_set('Asia/Kolkata');
} catch (Exception $ex) {
    echo "something went wrong" . $ex->getMessage();
    exit;
}
