<?php
require('Dbconnection.php');
if(isset($_POST['order_num'])){
    $order_num = $_POST['order_num'];
    try {
        $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname,order_tb.orderproduct_name, order_tb.order_quantity, SUM(order_tb.order_amount) AS total_amount, order_tb.order_num, order_tb.order_time, user_tb.usertype, student_tb.course, student_tb.studentID_number, personnel_tb.department FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id INNER JOIN order_tb ON user_tb.user_id = order_tb.user_id WHERE order_tb.order_num = '$order_num' GROUP BY order_tb.order_num;");
        
        $array_data = array();
        while($row = mysqli_fetch_assoc($sql)){
            if($row['course']!=null){
                $department = $row['course'];
            }else{
                $department = $row['department'];
            }
            $array_data[] = array('name'=>$row['firstname']." ".$row['lastname'], 'department'=>$department, 'date'=>$row['order_time'], 'total_amount'=>$row['total_amount'], 'ref_num'=>$row['order_num'], "user_data_id" => $row['studentID_number']);
        }
        print_r(json_encode($array_data));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>