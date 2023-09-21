<?php
 
$dbUser='root';
$dbHost='localhost';
$dbPassword='';
$dbName='bcc_digital_payment';

try {
    $connect = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
} catch (\Throwable $th) {
    echo $th;
}
?>