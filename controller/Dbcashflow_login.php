<?php
require('Dbconnection.php');
if(isset($_POST['user_name'])&&isset($_POST['password'])){
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']);

    try {
        $sql = mysqli_query($connect, "SELECT user_category FROM `admin_tb` WHERE username = '$user_name' AND password = '$password'");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if(isset($row['user_category'])){
        echo $row['user_category'];
    }else{
        echo "wrong_password";
    }
    
}
?>