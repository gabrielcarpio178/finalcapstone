<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $isInbago = 'unpaid';
    try {
        $sql = mysqli_query($connect, "SELECT `address` FROM `user_tb` WHERE `user_id` = '$user_id';");
        $row = mysqli_fetch_assoc($sql);
        if($row['address']=='bago'){
            $isInbago = 'paid';
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    if($isInbago=='unpaid'){


        try {
            $sql_semister = mysqli_query($connect, "SELECT `semester`, semester_start FROM semesteryear_tb ORDER BY semesterYear_id DESC LIMIT 1");
            $semister_row = mysqli_fetch_assoc($sql_semister);
            $semister = $semister_row['semester'];
            $semister_start = $semister_row['semester_start'];
        } catch (\Throwable $th) {
            echo $th;
        }

        try {
            $sql_ispaid = mysqli_query($connect, "SELECT COUNT(`payment_type`) AS isPaid FROM `digitalpayment_tb` WHERE `user_id` = '$user_id' AND `payment_type` = 'Non Bago fee' AND (CAST(payment_date AS DATE) BETWEEN '$semister_start' AND CAST(NOW() AS DATE)) AND semester_year = '$semister';");
            $ispaid = mysqli_fetch_assoc($sql_ispaid);
            if($ispaid['isPaid']==1){
                $isInbago = 'paid';
            }else{
                $isInbago = 'unpaid';
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    try {
        $get_amount = mysqli_query($connect, "SELECT `cashierRates_amount` FROM `cashierrates_tb` WHERE cashierRates_id = 1");
        $bcc_amount = mysqli_fetch_assoc($get_amount);
    } catch (\Throwable $th) {
        echo $th;
    }
    
    print_r(json_encode(['ispaid'=>$isInbago, 'bcc_amount'=>$bcc_amount['cashierRates_amount']]));
}
?>