<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['old_password'])&&isset($_POST['new_password'])&&isset($_POST['confirm_password'])){
    $id = $_SESSION['id'];
    $old_password = md5(strtolower($_POST['old_password']));
    $new_password = md5(strtolower($_POST['new_password']));
    $confirm_password = md5(strtolower($_POST['confirm_password']));

    try {
        $get_pasword_sql = mysqli_query($connect,"SELECT password FROM user_tb WHERE user_id = '$id';");
        $get_password = mysqli_fetch_assoc($get_pasword_sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($get_password['password']==$old_password){
        if($new_password==$confirm_password){
            try {
                mysqli_query($connect, "UPDATE `user_tb` SET `password`='$new_password' WHERE user_id = '$id';");
                echo "success";
            } catch (\Throwable $th) {
                echo $th;
            }
        }else{
            echo "not_match";
        }
    }else{
        echo "wrong_old_password";
    }
}
?>