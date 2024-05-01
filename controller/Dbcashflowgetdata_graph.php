<?php
require('Dbconnection.php');
if(isset($_POST['user'])){
    //cashin
    try {
        $cashin_sql = mysqli_query($connect, "SELECT SUM(cashin_amount) AS total_cashin_monthly, MONTHNAME(cashin_date) AS month_cashin FROM cashin_tb WHERE YEAR(CAST(cashin_date AS DATE)) = YEAR(CAST(NOW() AS DATE)) GROUP BY MONTH(cashin_date);");
        $cashin_array = array();
        $cashin_month = array();
        while($cashin_row = mysqli_fetch_assoc($cashin_sql)){
            $cashin_array[] = array("amount_cashin"=>$cashin_row['total_cashin_monthly'], "month"=>$cashin_row['month_cashin']);
            $cashin_month[] = $cashin_row['month_cashin'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    //cashout
    try {
        $cashout_sql = mysqli_query($connect, "SELECT SUM(cashout_amount) AS total_cashout_monthly, MONTHNAME(cashout_date) AS month_cashout FROM cashout_tb WHERE YEAR(CAST(cashout_date AS DATE)) = YEAR(CAST(NOW() AS DATE)) GROUP BY MONTH(cashout_date)");
        $cashout_array = array();
        $cashout_month = array();
        while($cashout_row = mysqli_fetch_assoc($cashout_sql)){
            $cashout_array[] = array("amount_cashout"=>$cashout_row['total_cashout_monthly'], "month"=>$cashout_row['month_cashout']);
            $cashout_month[] = $cashout_row['month_cashout'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    print_r(json_encode(array_merge($cashout_array, $cashin_array)));
}
?>