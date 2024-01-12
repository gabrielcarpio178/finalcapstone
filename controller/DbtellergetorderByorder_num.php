<?php
require('Dbconnection.php');
if(isset($_POST['order_num'])&&isset($_POST['type_content'])){
    $order_num = $_POST['order_num'];
    $type_content = $_POST['type_content'];
    if($type_content != 'cashout'){
        $sql = "SELECT CONCAT(user_tb.firstname, ' ', user_tb.lastname) AS name, SUM(order_tb.order_amount) AS total_amount, order_tb.order_num, order_tb.order_time, student_tb.course, student_tb.studentID_number AS statues, personnel_tb.department FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id INNER JOIN order_tb ON user_tb.user_id = order_tb.user_id WHERE order_tb.order_num = '$order_num' GROUP BY order_tb.order_num;";
    }else{
        $sql = "SELECT cashout_tb.`cashout_date` AS order_time ,telleruser_tb.store_name AS name, cashout_tb.cashout_status AS statues, cashout_tb.cashout_refnum AS order_num, cashout_tb.`cashout_amount` AS total_amount, ' ' AS course, ' ' AS department  FROM `cashout_tb` INNER JOIN `telleruser_tb` ON telleruser_tb.teller_id = cashout_tb.teller_id WHERE cashout_tb.cashout_refnum = '$order_num';";
    }

    function getdata($query, $connect){
        $array_data = array();
        try {
            $sql = mysqli_query($connect, $query);
            
            $array_data = array();
            while($row = mysqli_fetch_assoc($sql)){
                if($row['course']!=null){
                    $department = $row['course'];
                }else{
                    $department = $row['department'];
                }
                $array_data[] = array('name'=>$row['name'], 'department'=>$department, 'date'=>$row['order_time'], 'total_amount'=>$row['total_amount'], 'ref_num'=>$row['order_num'], "statues" => $row['statues']);
            }
            
        } catch (\Throwable $th) {
            echo $th;
        }
        return $array_data;
    }

    print_r(json_encode(getdata($sql, $connect)));
}
?>