<?php
require('Dbconnection.php');
if(isset($_POST['username'])&&isset($_POST['password'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    try {
        $sql = mysqli_query($connect, "SELECT `user_category` FROM `admin_tb` WHERE `username` = '$username' AND `password`='$password';");
        $count = mysqli_num_rows($sql);
        if($count==1){
            echo "valid";
        }else{
            echo "invalid";
        }
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>