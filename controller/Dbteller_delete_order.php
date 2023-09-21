<?php
session_start();
require('Dbconnection.php');

if(isset($_POST['order_num'])){
    $order_num = $_POST['order_num'];
    $teller_id = $_SESSION['id'];
    try {
        mysqli_query($connect, "DELETE FROM `order_tb` WHERE `order_num` = '$order_num' AND `teller_id` = '$teller_id';");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}

?>