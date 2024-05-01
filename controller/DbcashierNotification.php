<?php
require('Dbconnection.php');
if(isset($_POST['cashier'])){
    try {
        $sql_num_request = mysqli_query($connect, "SELECT COUNT(`requestType`) AS num_request FROM `digitalpayment_tb` WHERE `requestType` = 'pending';");
        $requestPayment = mysqli_fetch_assoc($sql_num_request);
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_num_cashOut = mysqli_query($connect, "SELECT COUNT(`cashout_status`) AS num_cashOut FROM `cashout_tb` WHERE `cashout_status` = 'pending';");
        $sql_num_cashOut = mysqli_fetch_assoc($sql_num_cashOut);
    } catch (\Throwable $th) {
        echo $th;
    }

    echo $requestPayment['num_request'] + $sql_num_cashOut['num_cashOut'];
}
?>