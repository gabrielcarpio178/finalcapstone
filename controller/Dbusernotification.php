<?php
require('Dbconnection.php');
date_default_timezone_set("Asia/Manila"); 
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $data_array = array();
    $data_purchase = array();
    $data_cashin = array();
    $data_sender = array();
    $data_receiver = array();
    $data_payment = array();

    try {
        $sql_purchase = mysqli_query($connect, "SELECT telleruser_tb.teller_gender, telleruser_tb.store_name, order_tb.deadline_time, order_tb.statues, order_tb.order_num, order_tb.user_id, order_tb.num_noti, order_tb.order_time FROM order_tb INNER JOIN telleruser_tb on order_tb.teller_id = telleruser_tb.teller_id WHERE user_id= '$user_id' GROUP BY order_num ORDER BY order_tb.order_id DESC;");
    } catch (\Throwable $th) {
        echo $th;
    }

    while($row_purchase = mysqli_fetch_assoc($sql_purchase)){ 
        $insert_time = ($row_purchase['deadline_time']!=NULL)?$row_purchase['deadline_time']:$row_purchase['deadline_time'];
        $data_purchase[] = array("date"=>$insert_time, "statues"=>$row_purchase['statues'],"store_name"=>ucfirst($row_purchase['store_name']), "teller_gender"=>$row_purchase['teller_gender'], "isSeen"=>$row_purchase['num_noti'], "order_num"=>$row_purchase['order_num'], "type"=>"purchase");
    }

    try {
        $sql_cashin = mysqli_query($connect, "SELECT `cashin_date`, `cashin_amount`, `cashin_noti`, `cashin_id` FROM cashin_tb WHERE user_id ='$user_id';");
    } catch (\Throwable $th) {
        throw $th;
    }

    while($row_cashin = mysqli_fetch_assoc($sql_cashin)){
        $data_cashin[] = array("date"=>$row_cashin['cashin_date'], "cashin_id"=>$row_cashin['cashin_id'],"cashin_amount"=>$row_cashin['cashin_amount'], "cashin_noti"=>$row_cashin['cashin_noti'], "isSeen"=>$row_cashin['cashin_noti'], "type"=>"cashin");
    }

    //sender
    try {
        $sql_sender = mysqli_query($connect, "SELECT sendbalance_tb.sendBalance_id, sendbalance_tb.sendBalance_Date, sendbalance_tb.send_amount, sendbalance_tb.sendbalance_noti, user_tb.firstname, user_tb.lastname, user_tb.image_profile, user_tb.gender FROM sendbalance_tb INNER JOIN user_tb ON user_tb.user_id = sendbalance_tb.receiver_id WHERE sendbalance_tb.sender_id = '$user_id';");
    } catch (\Throwable $th) {
        echo $th;
    }

    while ($row_sender = mysqli_fetch_assoc($sql_sender)) {
        $data_sender[] = array("id"=>$row_sender['sendBalance_id'], "date"=>$row_sender['sendBalance_Date'], "name"=>$row_sender['firstname']." ".$row_sender['lastname'], "amount"=>$row_sender['send_amount'], "type"=>"sent", "isSeen"=>$row_sender['sendbalance_noti'], "image_pp"=>$row_sender['image_profile'], "gender"=>$row_sender['gender']);
    }

    //receiver
    try {
        $sql_receiver = mysqli_query($connect, "SELECT sendbalance_tb.sendBalance_id, sendbalance_tb.sendBalance_Date, sendbalance_tb.send_amount, sendbalance_tb.sendbalance_noti, user_tb.firstname, user_tb.lastname, user_tb.image_profile, user_tb.gender FROM sendbalance_tb INNER JOIN user_tb ON user_tb.user_id = sendbalance_tb.sender_id WHERE sendbalance_tb.receiver_id = '$user_id';");
    } catch (\Throwable $th) {
        echo $th;
    }

    while ($row_receiver = mysqli_fetch_assoc($sql_receiver)) {
        $data_receiver[] = array("id"=>$row_receiver['sendBalance_id'], "date"=>$row_receiver['sendBalance_Date'], "name"=>$row_receiver['firstname']." ".$row_receiver['lastname'], "amount"=>$row_receiver['send_amount'], "type"=>"receiver", "isSeen"=>$row_receiver['sendbalance_noti'], "image_pp"=>$row_receiver['image_profile'], "gender"=>$row_receiver['gender']);
    }

    //payment_request
    try {
        $sql_payment = mysqli_query($connect, "SELECT `digitalPayment_id`, `payment_type`, `requestType`, `request_noti`, `payment_date` FROM `digitalpayment_tb` WHERE `user_id` = '$user_id' AND (`requestType` = 'accepted' OR `requestType` = 'cancel');");
    } catch (\Throwable $th) {
        echo $th;
    }

    while ($row_payment = mysqli_fetch_assoc($sql_payment)){
        $data_payment[] = array("date"=>$row_payment['payment_date'], "payment_id"=>$row_payment['digitalPayment_id'], "requestType"=>$row_payment['requestType'], "isSeen"=>$row_payment['request_noti'], "type"=>"payment", "payment_type"=>$row_payment['payment_type']);
    }

    $data_array = array_merge($data_purchase, $data_cashin, $data_sender, $data_receiver, $data_payment);
    print_r(json_encode($data_array));

}
?>


