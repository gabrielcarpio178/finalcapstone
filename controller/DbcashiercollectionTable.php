<?php
require('Dbconnection.php');
if(isset($_POST['sortBy'])&&isset($_POST['category'])){
    $sortBy = $_POST['sortBy'];
    $category = $_POST['category'];
    $sortBy_type = '';
    if($sortBy=='all'){
        $sortBy_type = '';
    }else{
        $sortBy_type = " AND payment_type ="."'$sortBy'";
    }
    
    if($category=='Non Bago Fee'){
        try {
            $non_bago_sql = mysqli_query($connect, "SELECT digitalpayment_tb.payment_amount, digitalpayment_tb.payment_ref, digitalpayment_tb.payment_date, user_tb.firstname, user_tb.lastname, student_tb.studentID_number FROM digitalpayment_tb INNER JOIN user_tb ON digitalPayment_tb.user_id = user_tb.user_id INNER JOIN student_tb ON digitalPayment_tb.user_id = student_tb.user_id WHERE digitalpayment_tb.payment_type = 'Non Bago Fee' AND CAST(digitalpayment_tb.payment_date AS DATE) = CAST(now() AS DATE) AND digitalpayment_tb.`requestType` = 'accepted';");
            $array_non_bago = array();
            $empty = 1;
            while($non_bago_row = mysqli_fetch_assoc($non_bago_sql)){
                $empty = 0;
                $array_non_bago[] = array("payment_amount"=>$non_bago_row['payment_amount'],"payment_ref"=>$non_bago_row['payment_ref'], "payment_date"=>$non_bago_row['payment_date'], "name"=>$non_bago_row['firstname']." ".$non_bago_row['lastname'], "student_id"=>$non_bago_row['studentID_number']);
            }
            if($empty != 0){
                echo $empty;
            }else{
                print_r(json_encode($array_non_bago));
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($category=='cash_out')
}
?>