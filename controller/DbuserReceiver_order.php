<?php
require('Dbconnection.php');
if(isset($_POST['order_num'])){
    $order_num = $_POST['order_num'];
    try {
        mysqli_query($connect, "UPDATE `order_tb` SET `statues`='PROCEED' WHERE `order_num` = '$order_num';");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>