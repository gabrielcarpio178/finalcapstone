<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['user'])){
    $id = $_SESSION['id'];
    $usertype = $_SESSION['usertype'];
    if($usertype=='student'){
        try {
            $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, student_tb.course, student_tb.year, user_tb.gender, user_tb.complete_address, user_tb.usertype, user_tb.phonenumber, user_tb.email, student_tb.studentID_number, user_tb.image_profile FROM user_tb INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id WHERE user_tb.user_id = '$id';");
            $row = mysqli_fetch_assoc($sql);
        } catch (\Throwable $th) {
            echo $th;
        }
        print_r(json_encode($row));
    }else{
        try {
            $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, personnel_tb.department, user_tb.gender, user_tb.complete_address, user_tb.usertype, user_tb.phonenumber, user_tb.email FROM user_tb INNER JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id WHERE user_tb.user_id = '$id'");
            $row = mysqli_fetch_assoc($sql);
        } catch (\Throwable $th) {
            echo $th;
        }
        print_r(json_encode($row));
    }
    
}
?>