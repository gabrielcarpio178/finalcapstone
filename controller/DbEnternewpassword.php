<?php
require('Dbconnection.php');
session_start();
sleep(1);
if(isset($_POST['new_password'])){
    $email = $_SESSION['email_to'];
    $new = md5($_POST['new_password']);

    try {
        mysqli_query($connect, "UPDATE `user_tb` SET `password`='$new' WHERE `email`='$email';");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }

}
?>