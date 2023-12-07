<?php
require('Dbconnection.php');
if(isset($_POST['order_num'])&&isset($_POST['teller_id'])){
    $order_num = $_POST['order_num'];
    $teller_id = $_POST['teller_id'];
    try {
        mysqli_query($connect, "UPDATE `order_tb` SET `statues`='PROCEED' WHERE `order_num` = '$order_num' AND `teller_id` = '$teller_id';");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>