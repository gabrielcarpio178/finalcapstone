<?php
require('Dbconnection.php');
if(isset($_POST['cashier'])){
    $total_cert = 0;
    $total_non_bago = 0;
    $total_cashin = 0;
    try {
        $sql_payment = mysqli_query($connect, "SELECT SUM(`payment_amount`) AS total_amount, `payment_type` FROM `digitalpayment_tb` WHERE `requestType` = 'accepted' GROUP BY`payment_type`;");
        while($row_payment = mysqli_fetch_assoc($sql_payment)){
            if($row_payment['payment_type']=="Certificate of Enrollment"||$row_payment['payment_type']=="Certificate  of Transfers"){
                $total_cert = $row_payment['total_amount'] + $total_cert;
            }else if($row_payment['payment_type']=="Non Bago Fee"){
                $total_non_bago = $row_payment['total_amount'] + $total_non_bago;
            }
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_total = mysqli_query($connect, "SELECT SUM(`cashin_amount`) AS total_cashin FROM `cashin_tb`;");
        $row_total = mysqli_fetch_assoc($sql_total);
        if(!empty($row_total['total_cashin'])){
            $total_cashin = (int)$row_total['total_cashin'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    $array = array("total_cert"=>$total_cert, "total_non_bago"=>$total_non_bago, "total_cashin"=>$total_cashin);
    print_r(json_encode($array));
}
?>