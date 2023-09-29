<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];

    try {
        $sql_totalPurchase =  mysqli_query($connect, "SELECT IFNULL(SUM(order_tb.order_amount), 0) AS total_purchase, order_tb.user_id FROM order_tb WHERE order_tb.user_id = '$user_id'  AND order_tb.statues IS NOT NULL GROUP BY order_tb.user_id;");
        $total_purchase = mysqli_fetch_assoc($sql_totalPurchase);
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_totalCashin = mysqli_query($connect, "SELECT IFNULL(SUM(cashin_amount), 0) AS total_cashin, user_id FROM cashin_tb WHERE user_id = '$user_id' GROUP BY user_id;");
        $total_cashin = mysqli_fetch_assoc($sql_totalCashin);
    } catch (\Throwable $th) {
        echo $th;
    }
    $total_cashin_user = 0;
    $total_purchase_user = 0;
     if(empty($total_cashin)==1){
        $total_cashin_user = 0;
     }elseif(empty($total_purchase)==1){
        $total_purchase_user = 0;
     }elseif(!empty($total_cashin)==1||!empty($total_purchase)==1){
        $total_cashin_user = $total_cashin['total_cashin'];
        $total_purchase_user = $total_purchase['total_purchase'];
     }
     echo $total_cashin_user-$total_purchase_user;


}
?>