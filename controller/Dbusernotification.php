<?php
require('Dbconnection.php');
date_default_timezone_set("Asia/Manila"); 
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    try {
        $sql = mysqli_query($connect, "SELECT telleruser_tb.teller_gender, telleruser_tb.store_name, order_tb.deadline_time, order_tb.statues, order_tb.order_num, order_tb.user_id, order_tb.num_noti FROM order_tb INNER JOIN telleruser_tb on order_tb.teller_id = telleruser_tb.teller_id WHERE user_id= '$user_id' GROUP BY order_num ORDER BY order_tb.order_id DESC;");
    } catch (\Throwable $th) {
        echo $th;
    }

    // $current = date('m/d/Y h:i:s', time());
    $data_array = array();
    $gender = array();
    $statues = array();
    $store_name = array();
    $num_noti = array();
    $deadline_time = array();
    $order_num = array();
    while($row = mysqli_fetch_assoc($sql)){ 
        $gender[] = $row['teller_gender'];
        $statues[] = $row['statues'];
        $store_name[] = ucfirst($row['store_name']);
        $deadline_time[] = $row['deadline_time'];
        $num_noti[] = $row['num_noti'];
        $order_num[] = $row['order_num'];
    }

    array_push($data_array, $gender, $statues, $store_name, $deadline_time, $num_noti, $order_num);
    print_r(json_encode($data_array));
}
?>


