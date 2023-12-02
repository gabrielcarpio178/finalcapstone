<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['type_info'])){
    $teller_id = $_SESSION['id'];
    $type_info = $_POST['type_info'];
    if($type_info=='pending'){
        
        $query = "SELECT order_tb.user_id, order_tb.order_time, SUM(order_tb.order_amount) AS total_amount, user_tb.firstname, user_tb.lastname, student_tb.course, personnel_tb.department, order_tb.order_num, order_tb.statues FROM order_tb INNER JOIN user_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON student_tb.user_id = user_tb.user_id LEFT JOIN personnel_tb ON personnel_tb.user_id = user_tb.user_id WHERE order_tb.teller_id = '$teller_id' AND order_tb.statues IS NULL AND CAST(order_tb.order_time AS DATE) = CAST(NOW() AS DATE) GROUP BY order_tb.order_num ORDER BY order_tb.order_time DESC;";

    }elseif($type_info=='accepted'){
        $query = "SELECT order_tb.user_id, order_tb.order_time, SUM(order_tb.order_amount) AS total_amount, user_tb.firstname, user_tb.lastname, student_tb.course, personnel_tb.department, order_tb.order_num, order_tb.deadline_time, order_tb.statues FROM order_tb INNER JOIN user_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON student_tb.user_id = user_tb.user_id LEFT JOIN personnel_tb ON personnel_tb.user_id = user_tb.user_id WHERE order_tb.teller_id = '$teller_id' AND order_tb.statues = 'ACCEPTED' AND CAST(order_tb.order_time AS DATE) = CAST(NOW() AS DATE) GROUP BY order_tb.order_num ORDER BY order_tb.order_time DESC;";
    }
    try {
        $sql = mysqli_query($connect, $query);
    } catch (\Throwable $th) {
        echo $th;
    }
    $array_data = array();
    while($row = mysqli_fetch_assoc($sql)){
        $department = ($row['course']!=NULL)?$row['course']:$row['department'];
        $order_set_time = (isset($row['deadline_time']))?$row['deadline_time']:'not_set';
        $statues = ($row['statues']!=NULL)?$row['statues']:'not_set';
        $array_data[] = array("order_time"=>$row['order_time'], "total_amount"=>$row['total_amount'], "name"=>$row['firstname']." ".$row['lastname'], "department"=>$department, "order_set_time"=>$order_set_time, "order_num"=>$row['order_num'], "user_id"=>$row['user_id'], "statues"=>$statues);
    }
    print_r(json_encode($array_data));

}
?>