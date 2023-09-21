<?php 
require("Dbconnection.php");
if(isset($_POST['teller_id'])){
    $teller_id = $_POST['teller_id'];

    //daily
    try {
        $sql = mysqli_query($connect, "SELECT IFNULL(SUM(order_amount), 0) AS total_amount_daily FROM order_tb WHERE statues = 'PROCEED' AND teller_id = '$teller_id' AND CAST(deadline_time AS DATE) = CAST(NOW() AS DATE);");
        $daily = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    };

    //monthly
    try {
        $sql_week = mysqli_query($connect, "SELECT SUM(order_amount) AS total_weekly FROM order_tb WHERE teller_id = '$teller_id' AND statues = 'PROCEED' AND MONTH(CAST(deadline_time AS DATE)) LIKE  MONTH(NOW())  GROUP BY MONTH(CAST(deadline_time AS DATE));");
        $weekly = mysqli_fetch_assoc($sql_week);
    } catch (\Throwable $th) {
        echo $th;
    };

    //yearly
    try {
        $sql_year = mysqli_query($connect, "SELECT IFNULL(SUM(order_amount), 0) AS total_yearly FROM order_tb WHERE statues = 'PROCEED' AND teller_id = '$teller_id' AND YEAR(deadline_time) LIKE YEAR(now()) GROUP BY YEAR(deadline_time);");
        $yearly = mysqli_fetch_assoc($sql_year);
    } catch (\Throwable $th) {
        echo $th;
    };

    //number of unpaid
    try {
        $sql_unpaid = mysqli_query($connect, "SELECT order_num FROM order_tb WHERE teller_id = '$teller_id' AND statues='ACCEPTED' GROUP BY order_num;");
        $unpaid = mysqli_num_rows($sql_unpaid);
    } catch (\Throwable $th) {
        echo $th;
    };

    //number of pending
    try {
        $sql_pending = mysqli_query($connect, "SELECT order_num FROM order_tb WHERE teller_id = '$teller_id' AND statues IS NULL GROUP BY order_num;");
        $pending = mysqli_num_rows($sql_pending);
    } catch (\Throwable $th) {
        echo $th;
    };

    try {
        $sql_proceed = mysqli_query($connect, "SELECT order_num FROM order_tb WHERE teller_id = '$teller_id' AND statues='PROCEED' GROUP BY order_num;");
        $proceed = mysqli_num_rows($sql_proceed);
    } catch (\Throwable $th) {
        echo $th;
    };



    
    $data = array();

    if(!empty($daily)){
        $data['daily'] = $daily['total_amount_daily'];
    }else{
        $data['daily'] = 0;
    }

    if(!empty($weekly)){
        $data['weekly'] = $weekly['total_weekly'];
    }else{
        $data['weekly'] = 0;
    }

    if(!empty($yearly)){
        $data['yearly'] = $yearly['total_yearly'];
    }else{
        $data['yearly'] = 0;
    }
    
    if($unpaid!=0){
        $data['unpaid'] = $unpaid;
    }else{
        $data['unpaid'] = 0;
    }

    if($pending!=0){
        $data['pending'] = $pending;
    }else{
        $data['pending'] = 0;
    }

    if($proceed!=0){
        $data['proceed'] = $proceed;
    }else{
        $data['proceed'] = 0;
    }

    print_r(json_encode($data));
    // print_r($data);
}
?>