<?php
require('Dbconnection.php');
if(isset($_POST['old_password'])&&isset($_POST['new_password'])){
    $old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    try {
        $sql_getpassword = mysqli_query($connect, "SELECT `password` FROM `cashier_tb`");
        $getpassword = mysqli_fetch_assoc($sql_getpassword);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($getpassword['password']!=$old_password){
        echo "wrong_old_password";
    }else{
        try {
            mysqli_query($connect, "UPDATE `cashier_tb` SET `password`='$new_password';");
            echo "success";
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
?>