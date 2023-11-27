<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];

    try {
        $sql = mysqli_query($connect, "SELECT `num_noti`, `order_num` FROM `order_tb` WHERE `user_id` = '$user_id' AND `num_noti` = '0';");
    } catch (\Throwable $th) {
        echo $th;
    }

    $array_purchase = array();

    while($row = mysqli_fetch_assoc($sql)){
        try {
            mysqli_query($connect, "UPDATE `order_tb` SET `num_noti`='1' WHERE `user_id` = '$user_id' AND `num_noti` = '".$row['num_noti']."';");
        } catch (\Throwable $th) {
            echo $th;
        }
        $array_purchase[] = array("id"=>$row['order_num'], 'type'=>"purchase");
    }

    try {
        $sql = mysqli_query($connect, "SELECT `cashin_noti`, `cashin_id` FROM `cashin_tb` WHERE `user_id` = '$user_id' AND `cashin_noti` = '0';");
    } catch (\Throwable $th) {
        echo $th;
    }

    $array_cashIn = array();

    while($row = mysqli_fetch_assoc($sql)){
        try {
            mysqli_query($connect, "UPDATE `cashin_tb` SET `cashin_noti`='1' WHERE `user_id` = '$user_id' AND `cashin_id` = '".$row['cashin_id']."';");
        } catch (\Throwable $th) {
            echo $th;
        }
        $array_cashIn[] = array("id"=>$row['cashin_id'], 'type'=>"cashin");
    }

    try {
        $sql = mysqli_query($connect, "SELECT `sendBalance_id`, `sendbalance_noti` FROM `sendbalance_tb` WHERE (sender_id = '$user_id' OR receiver_id = '$user_id') AND 	sendbalance_noti = '0'");
    } catch (\Throwable $th) {
        echo $th;
    }

    $array_transfer = array();

    while($row = mysqli_fetch_assoc($sql)){
        try {
            mysqli_query($connect, "UPDATE `sendbalance_tb` SET `sendbalance_noti`='1' WHERE `sendBalance_id`=".$row['sendBalance_id']);
        } catch (\Throwable $th) {
            echo $th;
        }
        $array_transfer[] = array("id"=>$row['sendBalance_id'], 'type'=>"transfer_funds");
    }

    $array = array_merge($array_purchase, $array_cashIn, $array_transfer);
    // print_r(json_encode($array));
    print_r($array);
}
?>