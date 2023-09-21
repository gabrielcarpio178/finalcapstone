<?php
require('Dbconnection.php');
session_start();
sleep(1);
if($_GET['logout']=='click'){    
    $id = $_SESSION['id'];
    try {
        mysqli_query($connect, "UPDATE `user_tb` SET `statues`='not-active' WHERE `user_id` = '$id';");
    } catch (\Throwable $th) {
        echo $th;
    }
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['teller_name']);
    unset($_SESSION['usertype']);
    unset($_SESSION['user']);
    unset($_SESSION['error']); 
    echo "success";
    die();  
}

?>
