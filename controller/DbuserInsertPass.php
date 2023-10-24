<?php
require('Dbconnection.php');;
session_start();
if(isset($_POST['password'])){
    $id = $_SESSION['id'];
    $password = md5($_POST['password']);
    try {
        $sql = mysqli_query($connect,"SELECT user_id FROM user_tb WHERE password = '$password';");
        $user_id = mysqli_fetch_assoc($sql);
        if(isset($user_id['user_id'])){
            if($user_id['user_id']==$id){
                echo "success";
            }else{
                echo "wrong_password";
            }
        }else{
            echo "wrong_password";
        }
        
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>