<?php
require('Dbconnection.php');
if(isset($_POST['user'])){
    //cashin_monthly

    try {
        $monthly_sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, cashin_tb.`cashin_date`, cashin_tb.`cashin_amount`, cashin_tb.`ref_num` FROM cashin_tb INNER JOIN user_tb ON cashin_tb.user_id = user_tb.user_id WHERE MONTH(cashin_tb.`cashin_date`) = MONTH(now()) AND YEAR(cashin_tb.`cashin_date`) = YEAR(now());");
        $month_array = array();
        while($monthly_row = mysqli_fetch_assoc($monthly_sql)){
            $month_array[] = array("name"=>$monthly_row['firstname']." ".$monthly_row['lastname'], "date"=>$monthly_row['cashin_date'], "amount"=>$monthly_row['cashin_amount'], "ref_num"=>$monthly_row['ref_num'], "type"=>"cashin");
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    //cashout_monthly

    try {
        $month_cashout_sql = mysqli_query($connect, "SELECT telleruser_tb.store_name, cashout_tb.cashout_date, cashout_tb.cashout_amount, cashout_tb.cashout_refnum FROM cashout_tb INNER JOIN telleruser_tb ON cashout_tb.teller_id = telleruser_tb.teller_id WHERE MONTH(cashout_tb.cashout_date) = MONTH(now()) AND YEAR(cashout_tb.cashout_date) = YEAR(now()) AND cashout_tb.cashout_status = 'accepted';");
        $month_cashout_array = array();
        while($month_cashout_row = mysqli_fetch_assoc($month_cashout_sql)){
            $month_cashout_array[] = array("name"=>$month_cashout_row['store_name'], "date"=>$month_cashout_row['cashout_date'], "amount"=>$month_cashout_row['cashout_amount'], "ref_num"=>$month_cashout_row['cashout_refnum'], "type"=>"cashout");
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    if(count($month_array)!=0||count($month_cashout_array)!=0){
        if(count($month_array)!=0&&count($month_cashout_array)==0){
            print_r(json_encode($month_cashout_array));
        }elseif(count($month_cashout_array)!=0&&count($month_array)==0){
            print_r(json_encode($month_array));
        }else{
            print_r(json_encode(array_merge($month_cashout_array, $month_array)));
        }
    }elseif(count($month_array)==0&&count($month_cashout_array)==0){
        print_r(json_encode(array("type"=>"no_record")));
    }

}
?>