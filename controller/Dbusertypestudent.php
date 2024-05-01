<?php
session_start();
require('Dbconnection.php');
sleep(1);
$id=$_POST['id'];
$student_id=$_POST['studentid'];
$department=$_POST['department_student'];
$year=$_POST['year'];

$show=mysqli_query($connect, "SELECT studentID_number FROM student_tb WHERE studentID_number='$student_id';");
$get=mysqli_fetch_assoc($show);
if(!empty($get)){
  echo "invalid";
}else{
  try{
    $insert=mysqli_query($connect, "INSERT INTO `student_tb`(`studentID_number`, `user_id`, `course`, `year`) VALUES ('$student_id','$id','$department','$year');");
    $update=mysqli_query($connect,"UPDATE `user_tb` SET `usertype`='student' WHERE user_id='$id';");
    $getuserquery = mysqli_query($connect, "SELECT usertype, user_id FROM `user_tb` WHERE user_id = '$id'");
    $row = mysqli_fetch_assoc($getuserquery);
    $_SESSION['id']=$row['user_id'];
    $_SESSION['usertype']=$row['usertype']; 
    echo "success";
  }catch(\Throwable $th){
    echo $th;
  }
}
?>
