<?php
require('Dbconnection.php');
if(isset($_POST['info'])){
    try {
        $sql = mysqli_query($connect, "SELECT COUNT(student_tb.course) AS total_course, COUNT(personnel_tb.department) AS total_department, student_tb.course, personnel_tb.department, user_tb.usertype FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id GROUP BY student_tb.course, personnel_tb.department;");
        // $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $total_teller_sql = mysqli_query($connect, "SELECT COUNT(*) AS total_num_teller FROM telleruser_tb;");
        $total_teller = mysqli_fetch_assoc($total_teller_sql);
    } catch (\Throwable $th) {
        echo $th;
    }

    $array = array();
    $personnel = array();
    $student = array();
    $all = array();
    $teller['teller'] = array($total_teller['total_num_teller']);
    $all['All']  = 0;
    while($row = mysqli_fetch_assoc($sql)){
        if($row['usertype']=='personnel'){
            $personnel[$row['department']] = $row['total_department'];
            $all['All'] = $row['total_department']+ $all['All'];
        }elseif($row['usertype']=='student'){
            $student[$row['course']] = $row['total_course'];
            $all['All'] = $row['total_course'] + $all['All'];
        }

    }

    array_push($array, $personnel, $student, $all, $teller);
    print_r(json_encode($array));
}
?>