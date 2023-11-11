<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['date'])&&isset($_POST['type'])){
    $user_id = $_SESSION['id'];
    $type = $_POST['type'];
    $date = $_POST['date'];

    if($type=='all'&&$date=="0000-00-00"){
        //purchase
        try {
            $purchase_sql = mysqli_query($connect, "SELECT telleruser_tb.store_name, order_tb.order_time, order_tb.order_amount, order_tb.user_id, order_tb.order_num FROM order_tb INNER JOIN telleruser_tb ON telleruser_tb.teller_id = order_tb.teller_id WHERE order_tb.user_id = '$user_id' AND order_tb.statues = 'PROCEED' GROUP BY order_tb.order_num LIMIT 20;");
            $purchase_array = array();
            while($purchase_row = mysqli_fetch_assoc($purchase_sql)){
                $purchase_array[] = array('trans_type'=>'purchase','store_name'=>$purchase_row['store_name'], 'date_info'=>$purchase_row['order_time'], 'order_amount'=>$purchase_row['order_amount'], 'order_num'=>$purchase_row['order_num']);
            }
            
        } catch (\Throwable $th) {
            echo $th;
        }
        //Cash in
        try {
            $cashin_sql = mysqli_query($connect, "SELECT `cashin_amount`, `cashin_date`, `ref_num` FROM `cashin_tb` WHERE `user_id` = '$user_id' LIMIT 20;");
            $cashIn_array = array();
            while($cashin_row = mysqli_fetch_assoc($cashin_sql)){
                $cashIn_array[] = array('trans_type'=>'cashin','cashin_amount'=>$cashin_row['cashin_amount'], 'date_info'=>$cashin_row['cashin_date'], 'ref_num'=>$cashin_row['ref_num']);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        //Sent tranfers funds
        try {
            $send_transFunds_sql = mysqli_query($connect, "SELECT `send_amount`, `sendBalance_Date`, `sendBalance_ref` FROM `sendbalance_tb` WHERE `sender_id` = '$user_id' LIMIT 20;");
            $send_transFunds_array = array();
            while($send_transFund_row = mysqli_fetch_assoc($send_transFunds_sql)){
                $send_transFunds_array[] = array('trans_type'=>'sent','send_amount'=>$send_transFund_row['send_amount'], 'date_info'=>$send_transFund_row['sendBalance_Date'], 'sendBalance_ref'=>$send_transFund_row['sendBalance_ref']);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        //receiver tranfers funds
        try {
            $receiver_transFunds_sql = mysqli_query($connect, "SELECT `send_amount`, `sendBalance_Date`, `sendBalance_ref` FROM `sendbalance_tb` WHERE `receiver_id` = '$user_id' LIMIT 20;");
            $receiver_transFunds_array = array();
            while($receiver_transFund_row = mysqli_fetch_assoc($receiver_transFunds_sql)){
                $receiver_transFunds_array[] = array('trans_type'=>'receiver','send_amount'=>$receiver_transFund_row['send_amount'], 'date_info'=>$receiver_transFund_row['sendBalance_Date'], 'type'=>'receiver', 'revBalance_ref'=>$receiver_transFund_row['sendBalance_ref']);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        
        //payment request
        try {
            $payment_sql = mysqli_query($connect, "SELECT `payment_type`, `payment_amount`, `payment_date` FROM `digitalpayment_tb` WHERE `user_id` = '$user_id' AND 	`requestType` = 'accepted' LIMIT 20;");
            $payment_array = array();
            while($payment_row = mysqli_fetch_assoc($payment_sql)){
                $payment_array[] = array('trans_type'=>'payment','payment_type'=>$payment_row['payment_type'], 'payment_amount'=>$payment_row['payment_amount'], 'date_info'=>$payment_row['payment_date']);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        $data_array = array_merge($purchase_array, $cashIn_array,  $send_transFunds_array, $receiver_transFunds_array, $payment_array);
        print_r(json_encode($data_array));
    }

}

?>