<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    try {
        $sql_order = mysqli_query($connect, "SELECT SUM(order_amount) AS wallet_balance FROM `order_tb` WHERE teller_id = '$user_id' AND statues = 'PROCEED';");
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_cashout = mysqli_query($connect, "SELECT SUM(cashout_amount) AS cashout FROM `cashout_tb` WHERE teller_id = '$user_id';");
    } catch (\Throwable $th) {
        echo $th;
    }

    $order_total = 0;
    $cashout_total = 0;
    while($order_row=mysqli_fetch_assoc($sql_order)){
        $order_total = $order_row['wallet_balance'];
    }
    
    while($cashout_row=mysqli_fetch_assoc($sql_cashout)){
        $cashout_total = $cashout_row['cashout'];
    }

    echo $order_total - $cashout_total;
}
?>