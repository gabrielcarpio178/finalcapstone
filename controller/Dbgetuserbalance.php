<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];

    try {
        $sql_totalPurchase =  mysqli_query($connect, "SELECT SUM(order_tb.order_amount) AS total_purchase, order_tb.user_id FROM order_tb WHERE order_tb.user_id = '$user_id'  AND order_tb.statues IS NOT NULL GROUP BY order_tb.user_id;");
        $total_purchase = mysqli_fetch_assoc($sql_totalPurchase);
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_totalCashin = mysqli_query($connect, "SELECT SUM(cashin_amount) AS total_cashin, user_id FROM cashin_tb WHERE user_id = '$user_id' GROUP BY user_id;");
        $total_cashin = mysqli_fetch_assoc($sql_totalCashin);
    } catch (\Throwable $th) {
        echo $th;
    }

    echo $total_cashin['total_cashin']-$total_purchase['total_purchase'];


}
?>