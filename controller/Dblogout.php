<?php
require('Dbconnection.php');
session_start();
sleep(1);
if(isset($_GET['logout'])){
    $id = $_GET['logout'];
    try {
        $sql = mysqli_query($connect, "SELECT `statues` FROM user_tb WHERE `user_id` = '$id';");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row['statues']=='active'){
        try {
            mysqli_query($connect, "UPDATE `user_tb` SET `statues`='not-active' WHERE `user_id` = '$id';");
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    unset($_SESSION['id']);
    unset($_SESSION['teller_name']);
    unset($_SESSION['usertype']);
    unset($_SESSION['user']);
    unset($_SESSION['error']); 
    echo "success";
    die();
}


?>
