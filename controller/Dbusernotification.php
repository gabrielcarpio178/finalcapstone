<?php
require('Dbconnection.php');
date_default_timezone_set("Asia/Manila"); 
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    
    try {
        $sql_purchase = mysqli_query($connect, "SELECT telleruser_tb.teller_gender, telleruser_tb.store_name, order_tb.deadline_time, order_tb.statues, order_tb.order_num, order_tb.user_id, order_tb.num_noti FROM order_tb INNER JOIN telleruser_tb on order_tb.teller_id = telleruser_tb.teller_id WHERE user_id= '$user_id' GROUP BY order_num ORDER BY order_tb.order_id DESC;");
    } catch (\Throwable $th) {
        echo $th;
    }

    $data_array = array();
    $data_purchase = array();
    $data_cashin = array();
    while($row_purchase = mysqli_fetch_assoc($sql_purchase)){ 
        $data_purchase[] = array("date"=>$row_purchase['deadline_time'], "statues"=>$row_purchase['statues'],"store_name"=>ucfirst($row_purchase['store_name']), "teller_gender"=>$row_purchase['teller_gender'], "isSeen"=>$row_purchase['num_noti'], "order_num"=>$row_purchase['order_num'], "type"=>"purchase");
    }

    try {
        $sql_cashin = mysqli_query($connect, "SELECT `cashin_date`, `cashin_amount`, `cashin_noti`, `cashin_id` FROM cashin_tb WHERE user_id ='$user_id';");
    } catch (\Throwable $th) {
        throw $th;
    }

    while($row_cashin = mysqli_fetch_assoc($sql_cashin)){
        $data_cashin[] = array("date"=>$row_cashin['cashin_date'], "cashin_id"=>$row_cashin['cashin_id'],"cashin_amount"=>$row_cashin['cashin_amount'], "cashin_noti"=>$row_cashin['cashin_noti'], "isSeen"=>$row_cashin['cashin_noti'], "type"=>"cashin");
    }

    $data_array = array_merge($data_purchase, $data_cashin);
    print_r(json_encode($data_array));

}
?>


