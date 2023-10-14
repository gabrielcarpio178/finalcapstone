<?php
require('Dbconnection.php');
if(isset($_POST['cashier'])){
    //cash in
    try {
        $cashin_sql = mysqli_query($connect, "SELECT SUM(`cashin_amount`) AS total_cashin, CAST(`cashin_date` AS DATE) AS date_today FROM cashin_tb WHERE CAST(`cashin_date` AS DATE) = CAST(now() AS DATE);");
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
            }elseif($payment['payment_type'] == 'Certificate of Enrollment'){
                $cert_e = $payment['total_payment'];
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

    $datas = array('cashin'=>$cashin_data, 'payment_nonBago'=>$payment_nonBago, 'cert_e'=>$cert_e, 'cert'=>$cert, 'payment_sum'=>$payment_sum, 'cashout'=>$cashOut);
    print_r(json_encode($datas));
}
?>