<?php
session_start();
require('Dbconnection.php');
sleep(1);
$id=$_POST['id_personnel'];;
$department=$_POST['department'];
  try{
    mysqli_query($connect, "INSERT INTO `personnel_tb`(`user_id`, `department`) VALUES ('$id','$department');");
    mysqli_query($connect,"UPDATE `user_tb` SET `usertype`='personnel' WHERE user_id='$id';");
    $getuserquery = mysqli_query($connect, "SELECT usertype, user_id FROM `user_tb` WHERE user_id = '$id'");
    $row = mysqli_fetch_assoc($getuserquery);
    $_SESSION['id']=$row['user_id'];
    $_SESSION['id']=$row['user_id'];
    $_SESSION['usertype']=$row['usertype']; 
    echo "success";
  }catch(\Throwable $th){
    echo $th;
  }
?>
