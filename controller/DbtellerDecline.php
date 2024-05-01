<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['order_num'])){
    $teller_id = $_SESSION['id'];
    $order_num = $_POST['order_num'];
    try {
        $sql = mysqli_query($connect, "SELECT statues FROM order_tb WHERE teller_id = '$teller_id' AND order_num = '$order_num' GROUP BY order_num;");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row['statues']=='ACCEPTED'){
        try {
            mysqli_query($connect, "UPDATE `order_tb` SET `statues`= NULL, `deadline_time` = NULL, `num_noti` = NULL WHERE order_num = '$order_num'");
            echo $row['statues'];
        } catch (\Throwable $th) {
            echo $th;
        }
    }else{
        try {
            mysqli_query($connect, "UPDATE `order_tb` SET `statues`= 'CANCELED', `deadline_time` = NOW(), `num_noti` = '0' WHERE order_num = '$order_num'");
            echo $row['statues'];
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
?>