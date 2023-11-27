<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['name'])&&isset($_POST['department'])&&isset($_POST['date_filter'])){
    $teller_id = $_SESSION['id'];
    $name = strtoupper($_POST['name']);
    $department = $_POST['department'];
    $date_filter = $_POST['date_filter'];
    if($name=='ALL'&&$department=='all'&&($date_filter=='all'||$date_filter=='')){
        try {
            $sql = mysqli_query($connect, "SELECT order_tb.order_time, user_tb.firstname, user_tb.lastname, student_tb.course, order_tb.order_num, personnel_tb.department, SUM(order_tb.order_amount) AS total_amount FROM user_tb INNER JOIN order_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON order_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id WHERE (order_tb.statues = 'PROCEED' OR order_tb.statues = 'PURCHASE') AND order_tb.teller_id = '$teller_id' GROUP BY order_tb.order_num ORDER BY order_tb.order_id DESC;");
            $array_table = array();
            while($row = mysqli_fetch_assoc($sql)){
                if($row['course']==null){
                    $department = $row['department'];
                }else{
                    $department = $row['course'];
                }
                $array_table[] = array('order_time'=>$row['order_time'], 'name'=>$row['firstname']." ".$row['lastname'], 'department'=>$department, 'order_num'=>$row['order_num'], 'total_amount'=>$row['total_amount']);
            }
            print_r(json_encode($array_table));
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    else{
        if($name=='ALL'||$name==''){
            $name_filter = "";
        }else{
            $name_filter = " AND (user_tb.firstname LIKE '$name%' OR user_tb.lastname LIKE '$name%')";
        }
        if($department=='all'){
            $department_filter = "";
        }else{
            $department_filter = " AND (personnel_tb.department = '$department' OR student_tb.course = '$department')";
        }
        if($date_filter=='all'||$date_filter==''){
            $date_filter_cot = "";
        }else{
            $date_filter_cot =  " AND CAST(order_tb.order_time AS DATE) = '$date_filter'";
        }
        try {
            $sql = mysqli_query($connect, "SELECT order_tb.order_time, user_tb.firstname, user_tb.lastname, student_tb.course, order_tb.order_num, personnel_tb.department, SUM(order_tb.order_amount) AS total_amount FROM user_tb INNER JOIN order_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON order_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id WHERE (order_tb.statues = 'PROCEED' OR order_tb.statues = 'PURCHASE') AND order_tb.teller_id = '$teller_id'".$department_filter.$name_filter.$date_filter_cot." GROUP BY order_tb.order_num ORDER BY order_tb.order_id DESC");
            $array_table = array();
            while($row = mysqli_fetch_assoc($sql)){
                if($row['course']==null){
                    $department = $row['department'];
                }else{
                    $department = $row['course'];
                }
                $array_table[] = array('order_time'=>$row['order_time'], 'name'=>$row['firstname']." ".$row['lastname'], 'department'=>$department, 'order_num'=>$row['order_num'], 'total_amount'=>$row['total_amount']);
            }
            print_r(json_encode($array_table));
        } catch (\Throwable $th) {
            echo $th;
        }

    }
}
?>