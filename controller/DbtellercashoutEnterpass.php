<?php
require('Dbconnection.php');
if(isset($_POST['insert_password'])&&isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $password = md5($_POST['insert_password']);
    try {
        $sql = mysqli_query($connect, "SELECT `password` FROM `telleruser_tb` WHERE `teller_id` = '$user_id';");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    $result = 'wrong';
    if($row['password']==$password){
        $result = 'success';
    }
    echo $result;
}
?>