<?php
session_start();
require('Dbconnection.php');

if(isset($_POST['order_num'])){
    $order_num = $_POST['order_num'];
    $teller_id = $_SESSION['id'];
    try {
        mysqli_query($connect, "UPDATE `order_tb` SET `statues`='CANCELED', `deadline_time` = NOW(), `num_noti` = '0' WHERE `order_num` = '$order_num' AND `teller_id` = '$teller_id';");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}

?>