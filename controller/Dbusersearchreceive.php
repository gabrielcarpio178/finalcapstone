<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $id = $_SESSION['id'];
    try {
        $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.user_id, user_tb.lastname, student_tb.studentID_number, student_tb.course, personnel_tb.personnelUser_id, personnel_tb.department, user_tb.phonenumber, user_tb.address, user_tb.usertype FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id WHERE user_tb.firstname LIKE '$search%' OR user_tb.lastname LIKE '$search%' OR student_tb.studentID_number LIKE '$search%' OR personnel_tb.personnelUser_id LIKE '$search%' LIMIT 0, 5;");
        $array_data = array();
        while($row = mysqli_fetch_assoc($sql)){
            if($row['user_id']!=$id){
                if($row['course']!=NULL){
                    $department = $row['course'];
                    $user_id = $row['studentID_number'];
                }else{
                    $department = $row['department'];
                    $user_id = $row['personnelUser_id'];
                }
                $array_data[] = array("user_id" => $row['user_id'], "name" => $row['firstname']." ".$row['lastname'], "department" => $department, "id" => $user_id, "phonenumber" => $row['phonenumber'], "address" => $row['address'], "usertype" => ucfirst($row['usertype']));
            }
        }
        print_r(json_encode($array_data));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>