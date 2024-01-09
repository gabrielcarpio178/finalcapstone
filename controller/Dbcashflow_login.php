<?php
require('Dbconnection.php');
session_start();
sleep(1);
if(isset($_POST['user_name'])&&isset($_POST['password'])&&isset($_POST['category'])&&isset($_POST['start'])&&isset($_POST['end'])){
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']);
    $category = $_POST['category'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    try {
        $sql = mysqli_query($connect, "SELECT user_category FROM `admin_tb` WHERE username = '$user_name' AND password = '$password'");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if(isset($row['user_category'])){
        echo $row['user_category'];
        $_SESSION['category'] = $category;
        $_SESSION['start'] = $start;
        $_SESSION['end'] = $end;
    }else{
        echo "wrong_password";
    }
    
}
?>