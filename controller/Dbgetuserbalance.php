<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];

    try {
        $sql_totalPurchase =  mysqli_query($connect, "SELECT SUM(order_tb.order_amount) AS total_purchase, order_tb.user_id FROM order_tb WHERE order_tb.user_id = '$user_id'  AND order_tb.statues IS NOT NULL GROUP BY order_tb.user_id;");
        
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_totalCashin = mysqli_query($connect, "SELECT SUM(cashin_amount) AS total_cashin, user_id FROM cashin_tb WHERE user_id = '$user_id' GROUP BY user_id;");

    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_total_payment = mysqli_query($connect,"SELECT SUM(payment_amount) AS total_payment, user_id FROM digitalpayment_tb WHERE user_id = '$user_id' GROUP BY user_id;");
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
        $total_purchase_user = $total_purchase['total_purchase'];
    }
    
    while($total_cashin = mysqli_fetch_assoc($sql_totalCashin)){
        $total_cashin_user = $total_cashin['total_cashin'];
    }

    echo $total_cashin_user - ($total_purchase_user+$total_payment_user);

}
?>