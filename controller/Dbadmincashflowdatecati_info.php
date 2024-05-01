<?php
require('Dbconnection.php');
if(isset($_POST['user'])){

    //cashin_daily
    try {
        $cashin_daily_sql = mysqli_query($connect, "SELECT SUM(`cashin_amount`) AS total_cashin FROM cashin_tb WHERE CAST(cashin_date AS DATE) = CAST(now() AS DATE) GROUP BY CAST(cashin_date AS DATE)");
        $cashin_daily = mysqli_fetch_assoc($cashin_daily_sql);
    } catch (\Throwable $th) {
        echo $th;
    }

    //cashout_daily
    try {
        $cashout_daily_sql = mysqli_query($connect, "SELECT SUM(`cashout_amount`) AS total_cashout FROM cashout_tb WHERE CAST(`cashout_date` AS DATE) = CAST(now() AS DATE) GROUP BY CAST(`cashout_date` AS DATE);");
        $cashout_daily = mysqli_fetch_assoc($cashout_daily_sql);
    } catch (\Throwable $th) {
        echo $th;
    }

    //cashin_collection
    try {
        $cashin_collection_sql = mysqli_query($connect, "SELECT SUM(`cashin_amount`) AS cashin_collection FROM cashin_tb");
        $cashin_collection = mysqli_fetch_assoc($cashin_collection_sql);
    } catch (\Throwable $th) {
        echo $th;
    }
     //cashout_collection
    try {
        $cashout_collection_sql = mysqli_query($connect, "SELECT SUM(`cashout_amount`) AS cashout_collection FROM cashout_tb");
        $cashout_collection = mysqli_fetch_assoc($cashout_collection_sql);
    } catch (\Throwable $th) {
        echo $th;
    }



    $cashin_daily['total_cashin'] = (isset($cashin_daily['total_cashin']))?$cashin_daily['total_cashin']:'0';
    $cashout_daily['total_cashout'] = (isset($cashout_daily['total_cashout']))?$cashout_daily['total_cashout']:'0';
    $cashin_collection['cashin_collection'] = (isset($cashin_collection['cashin_collection']))?$cashin_collection['cashin_collection']:'0';
    $cashout_collection['cashout_collection'] = (isset($cashout_collection['cashout_collection']))?$cashout_collection['cashout_collection']:'0';
    $available_collection = $cashin_collection['cashin_collection']-$cashout_collection['cashout_collection'];


    $data_array = array("total_cashin"=>$cashin_daily['total_cashin'], "total_cashout"=>$cashout_daily['total_cashout'], "cashin_collection"=>$available_collection);
    
    print_r(json_encode($data_array));
}

?>