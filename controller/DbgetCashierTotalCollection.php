<?php
require('Dbconnection.php');
if(isset($_POST['cashier'])){
    $total_cashin = 0;
    try {
        $sql_total = mysqli_query($connect, "SELECT SUM(`cashin_amount`) AS total_cashin FROM `cashin_tb` WHERE CAST(cashin_date AS DATE) = CAST(now() AS DATE);");
        $row_total = mysqli_fetch_assoc($sql_total);
        if(!empty($row_total['total_cashin'])){
            $total_cashin = $row_total['total_cashin'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    $total_payment = 0;
    try {
        $sql_totalPayment = mysqli_query($connect, "SELECT SUM(`payment_amount`) AS total_payment FROM digitalpayment_tb WHERE `requestType` = 'accepted' AND CAST(`payment_date` AS DATE) = CAST(now() AS DATE);");
        $row_totalPayment = mysqli_fetch_assoc($sql_totalPayment);
        if(!empty($row_totalPayment['total_payment'])){
            $total_payment = $row_totalPayment['total_payment'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    echo $total_cashin + $total_payment;
}
?>