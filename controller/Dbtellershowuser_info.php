<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['order_num'])){
    $order_num = $_POST['order_num'];
    $teller_id = $_SESSION['id'];
    try {
        $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname,order_tb.orderproduct_name, order_tb.order_quantity, order_tb.order_amount, order_tb.order_num, order_tb.order_time, user_tb.usertype, student_tb.course, student_tb.studentID_number, personnel_tb.department FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id INNER JOIN order_tb ON user_tb.user_id = order_tb.user_id WHERE order_tb.teller_id = '$teller_id' AND order_tb.statues = 'PROCEED' AND order_tb.order_num = '$order_num';");

        $row = mysqli_fetch_assoc($sql);

    } catch (\Throwable $th) {
        echo $th;
    }
}

$info_array = array();
if(!empty($row)){
    $total_amount = 0;
    do{
        $info_array['name'] = $row['firstname']." ".$row['lastname']; 
        $info_array['order_num'] = $row['order_num'];
        $total_amount = $row['order_amount'] + $total_amount;
        $info_array['date_time'] = $row['order_time'];
        $info_array['usertype'] = $row['usertype'];
        $info_array['studentID_number'] = $row['studentID_number'];
        if($row['usertype']=="student"){
            $info_array['department'] = $row['course'];
        }else{
            $info_array['department'] = $row['department'];
        }
    }while($row = mysqli_fetch_array($sql));
    $info_array['total_amount'] =  $total_amount;
    
}
// print_r();
print_r(json_encode($info_array));
?>
