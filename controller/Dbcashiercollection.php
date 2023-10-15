<?php
require('Dbconnection.php');
if(isset($_POST['cashier'])){
    //cash in
    try {
        $cashin_sql = mysqli_query($connect, "SELECT SUM(`cashin_amount`) AS total_cashin FROM cashin_tb WHERE CAST(`cashin_date` AS DATE) = CAST(now() AS DATE);");
        $cashin_data = 0;
        $cashin = mysqli_fetch_assoc($cashin_sql);
        if($cashin['total_cashin']!=NULL){
            $cashin_data = $cashin['total_cashin'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    //school fee
    try {
        $payment_sql = mysqli_query($connect, "SELECT SUM(`payment_amount`) AS total_payment, `payment_date`, `payment_type` FROM digitalpayment_tb WHERE CAST(`payment_date` AS DATE) = CAST(now() AS DATE) AND `requestType` = 'accepted' GROUP BY `payment_type`;");
        $payment_sum = 0;
        $payment_nonBago = 0;
        $cert_e = 0;
        $cert = 0;
        while($payment = mysqli_fetch_assoc($payment_sql)){
            if($payment['payment_type'] == 'Non Bago Fee'){
                $payment_nonBago = $payment['total_payment'];
            }elseif($payment['payment_type'] == 'Certificate  of Transfers'){
                $cert_t = $payment['total_payment'];
            }else{
                $cert = $payment['total_payment'];
            }
            $payment_sum += $payment['total_payment'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    //cash out
    try {
        $cashOut_sql = mysqli_query($connect, "SELECT SUM(`cashout_amount`) AS total_cashout, `cashout_date` FROM cashout_tb WHERE `cashout_status`='accepted' AND CAST(`cashout_date` AS DATE) = CAST(now() AS DATE);");
        $cashOut = 0;
        $cashOut_data = mysqli_fetch_assoc($cashOut_sql);
        if($cashOut_data['total_cashout']!=NULL){
            $cashOut = $cashOut_data['total_cashout'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    //total_collection
    try {
        $collection_cashin_sql = mysqli_query($connect, "SELECT SUM(`cashin_amount`) AS total_cashin FROM cashin_tb;");
        $collection_cashin_row =mysqli_fetch_assoc($collection_cashin_sql);
        $collection_cashin = 0;
        if($collection_cashin_row['total_cashin']!=NULL){
            $collection_cashin = $collection_cashin_row['total_cashin'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    //total_payment
    try {
        $total_payment_sql = mysqli_query($connect, "SELECT SUM(`payment_amount`) AS total_payment FROM digitalpayment_tb WHERE `requestType` = 'accepted';");
        $total_payment_row = mysqli_fetch_assoc($total_payment_sql);
        $total_payment = 0;
        if($total_payment_row['total_payment']!=NULL){
            $total_payment = $total_payment_row['total_payment'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    $total_collection = $total_payment+$collection_cashin;

    $datas = array('cashin'=>$cashin_data, 'payment_nonBago'=>$payment_nonBago, 'cert_t'=>$cert_t, 'cert'=>$cert, 'payment_sum'=>$payment_sum, 'cashout'=>$cashOut, 'total_collection'=>$total_collection);
    print_r(json_encode($datas));
}
?>