<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $id = $_POST['user_id'];
    try{
        $sql = mysqli_query($connect, "SELECT order_tb.user_id, order_tb.teller_id, order_tb.order_time, telleruser_tb.store_name, order_tb.statues, order_tb.order_num FROM order_tb INNER JOIN telleruser_tb ON order_tb.teller_id = telleruser_tb.teller_id WHERE `user_id` = '$id' AND (order_tb.statues IS NULL OR order_tb.statues = 'ACCEPTED' OR order_tb.statues = 'PROCEED') AND (CAST(order_tb.order_time AS DATE) = CAST(NOW() AS DATE)) AND order_tb.isRemove IS NULL GROUP BY order_tb.order_num, order_tb.teller_id ORDER BY order_tb.order_id DESC;");
        $array_result = array();
        while($row = mysqli_fetch_assoc($sql)){
            $array_result[] = array('order_num' => $row['order_num'], 'order_date' => date_format(date_create($row['order_time']), "Y-m-d"), 'store_name'=>ucfirst($row['store_name']));
        }
        print_r(json_encode($array_result));
    }catch(\Throwable $th){
        echo $th;
    }
}