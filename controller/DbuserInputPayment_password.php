<?php
require('Dbconnection.php');
if(isset($_POST['password'])){
    $password = md5($_POST['password']);
    try {
        $sql = mysqli_query($connect, "SELECT password FROM user_tb WHERE password = '$password';");
        $row = mysqli_fetch_assoc($sql);
        if(!empty($row)){
            echo "success";
        }else{
            echo "wrong_password";
        }
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>