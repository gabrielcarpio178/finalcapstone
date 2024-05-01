<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['password'])){
    $user_id = $_SESSION['id'];
    $password = md5($_POST['password']);
    try {
        $sql = mysqli_query($connect, "SELECT * FROM user_tb WHERE user_id = '$user_id';");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row['password']==$password){
        echo 'valid';
    }else{
        echo 'invalid';
    }
}
?>