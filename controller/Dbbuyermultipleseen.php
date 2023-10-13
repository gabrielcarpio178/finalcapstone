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
        $array_purchase[] = $row['order_num'];
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
        $array_cashIn[] = $row['cashin_id'];
    }
    $array = array_merge($array_purchase, $array_cashIn);
    print_r(json_encode($array));
}
?>