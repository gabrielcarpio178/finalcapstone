<?php
require('Dbconnection.php');
if(isset($_POST['password'])&&isset($_POST['user_id'])){
    $password = md5($_POST['password']);
    $user_id = $_POST['user_id'];
    try {
        $sql = mysqli_query($connect, "SELECT password FROM user_tb WHERE user_id = '$user_id';");
        $row = mysqli_fetch_assoc($sql);
        if($row['password']==$password){
            echo "success";
        }else{
            echo "wrong_password";
        }
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>