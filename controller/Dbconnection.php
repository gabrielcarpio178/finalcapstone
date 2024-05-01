<?php

$dbUser='root';
$dbHost='127.0.0.1:8080';    
$dbPassword='';
$dbName='digitalpay';

try {
    $connect = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
} catch (\Throwable $th) {
    echo $th;
}
?>