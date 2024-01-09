<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    //SELECT SUM(order_tb.order_amount) AS total_purchase, order_tb.user_id FROM order_tb WHERE order_tb.user_id = '$user_id' AND order_tb.statues IS NOT NULL GROUP BY order_tb.user_id;
    try {
        $sql_totalPurchase =  mysqli_query($connect, "SELECT SUM(order_tb.order_amount) AS total_purchase, order_tb.user_id FROM order_tb WHERE order_tb.user_id = '$user_id' AND (order_tb.statues = 'PROCEED' OR order_tb.statues = 'ACCEPTED' OR (order_tb.statues IS NULL AND CAST(order_tb.order_time AS DATE) = CAST(NOW() AS DATE)));");
        
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_totalCashin = mysqli_query($connect, "SELECT SUM(cashin_amount) AS total_cashin, user_id FROM cashin_tb WHERE user_id = '$user_id'");

    } catch (\Throwable $th) {
        echo $th;
    }
    // SELECT SUM(payment_amount) AS total_payment, user_id FROM digitalpayment_tb WHERE user_id = '$user_id' AND requestType = 'accepted' GROUP BY user_id;
    try {
        $sql_total_payment = mysqli_query($connect,"SELECT SUM(payment_amount) AS total_payment, user_id FROM digitalpayment_tb WHERE user_id = '$user_id' AND (requestType='pending' OR requestType='accepted')");
    } catch (\Throwable $th) {
        echo $th;
    }
    $total_cashin_user = 0;
    $total_purchase_user = 0;
    $total_payment_user = 0;
    while($total_payment = mysqli_fetch_assoc($sql_total_payment)){
        $total_payment_user = $total_payment['total_payment'];
    }
    while($total_purchase = mysqli_fetch_assoc($sql_totalPurchase)){
        $total_purchase_user += $total_purchase['total_purchase'];
    }
    
    while($total_cashin = mysqli_fetch_assoc($sql_totalCashin)){
        $total_cashin_user = $total_cashin['total_cashin'];
    }

    try {
        $sended_amount_sql = mysqli_query($connect, "SELECT SUM(send_amount) AS sended_amount FROM `sendbalance_tb` WHERE `sender_id` = '$user_id'");
        $count_data = mysqli_num_rows($sended_amount_sql);
        $sended_amount = 0;
        if($count_data!=0){
            $sended_row = mysqli_fetch_assoc($sended_amount_sql);
            $sended_amount = $sended_row['sended_amount'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $receiver_amount_sql = mysqli_query($connect, "SELECT SUM(send_amount) AS receiver_amount FROM `sendbalance_tb` WHERE `receiver_id` = '$user_id'");
        $count_data = mysqli_num_rows($receiver_amount_sql);
        $receiver_amount = 0;
        if($count_data!=0){
            $receiver_row = mysqli_fetch_assoc($receiver_amount_sql);
            $receiver_amount = $receiver_row['receiver_amount'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    echo ($total_cashin_user+$receiver_amount) - ($total_purchase_user+$total_payment_user+$sended_amount);

}
?>