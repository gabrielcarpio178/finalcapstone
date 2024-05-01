<?php
require('Dbconnection.php');
if(isset($_POST['admin'])){

    try {
        $sql = mysqli_query($connect, "SELECT user_category, COUNT(*) AS total_number, MONTHNAME(`use_date`) AS months FROM `userwebusages_tb` GROUP BY MONTH(`use_date`), user_category;");
        $dataarray = array();
        $total = array();
        $month = array();
        
        while($data = mysqli_fetch_assoc($sql)){
            $month[] = $data['months'];
            $total[$data['user_category']][$data['months']][] = $data['total_number'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_num = mysqli_query($connect, "SELECT COUNT(student_tb.course) AS num_course, COUNT(personnel_tb.department) AS num_department, student_tb.course, personnel_tb.department, user_tb.usertype FROM user_tb LEFT JOIN personnel_tb ON personnel_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON student_tb.user_id = user_tb.user_id GROUP BY student_tb.course, personnel_tb.department;");
        $department = array();
        $course = array();
        while($num = mysqli_fetch_assoc($sql_num)){
            if($num['usertype']=='personnel'){
                $department['department'][] = $num['department'];
                $department['num_department'][] = $num['num_department'];
            }elseif($num['usertype']=='student'){
                $course['course'][] = $num['course'];
                $course['num_course'][] = $num['num_course'];
            }
        }
    } catch (\Throwable $th) {
        //throw $th;
    }

    array_push($dataarray, $month, $total, $course, $department);
    print_r(json_encode($dataarray));
    // print_r($department);



}
?>