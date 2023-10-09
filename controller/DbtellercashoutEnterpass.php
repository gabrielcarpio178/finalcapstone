<?php
require('Dbconnection.php');
if(isset($_POST['insert_password'])){
    $password = md5($_POST['insert_password']);
    try {
        $sql = mysqli_query($connect, "SELECT `password` FROM `telleruser_tb` WHERE `password` = '$password';");
    } catch (\Throwable $th) {
        echo $th;
    }
    $result = 'wrong';
    while($row = mysqli_fetch_assoc($sql)){
        $result = 'success';
    }
    echo $result;
}
?>