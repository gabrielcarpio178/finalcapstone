<?php
require('Dbconnection.php');
if(isset($_POST['search'])){
    $search = $_POST['search'];
    try {
        $sql_result = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, user_tb.email, user_tb.phonenumber, user_tb.usertype, student_tb.studentID_number, personnel_tb.personnelUser_id, user_tb.user_id FROM user_tb LEFT JOIN student_tb ON student_tb.user_id = user_tb.user_id LEFT JOIN personnel_tb ON personnel_tb.user_id = user_tb.user_id WHERE student_tb.studentID_number LIKE '$search%' OR user_tb.firstname LIKE '$search%' OR user_tb.lastname LIKE '$search%' OR user_tb.email LIKE '$search%' OR user_tb.phonenumber LIKE '$search%' ORDER BY user_tb.user_id DESC LIMIT 10;");
    } catch (\Throwable $th) {
        echo $th;
    }
    $array = array();
    $firstname = array();
    $lastname = array();
    $email = array();
    $studentID_number = array();
    $phonenumber = array();
    $user_id = array();
    while($row = mysqli_fetch_assoc($sql_result)){
        $firstname[] = $row['firstname'];
        $lastname[] = $row['lastname'];
        $email[] = $row['email'];
        $user_id[] = $row['user_id'];
        if($row['usertype']=='student'){
            $studentID_number[] = $row['studentID_number'];
        }elseif($row['usertype']=='personnel'){
            $studentID_number[] = $row['personnelUser_id'];
        }   
        $phonenumber[] = $row['phonenumber'];
    }
    array_push($array, $firstname, $lastname, $email, $studentID_number,  $phonenumber, $user_id);
    print_r(json_encode($array));
}

?>