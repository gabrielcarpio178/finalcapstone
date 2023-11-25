<?php 
require('Dbconnection.php');
if(isset($_POST['user_id'])&&isset($_POST['num'])&&isset($_POST['type'])){
    $user_id = $_POST['user_id'];
    $num = $_POST['num'];
    $type = $_POST['type'];
    if($type=="purchase"){
        try {
            $sql = mysqli_query($connect, "SELECT `num_noti` FROM `order_tb` WHERE `user_id` = '$user_id' AND `order_num` = '$num';");
            $row = mysqli_fetch_assoc($sql);
        } catch (\Throwable $th) {
            echo $th;
        }
        if($row['num_noti']=='1'){
            try {
                mysqli_query($connect, "UPDATE `order_tb` SET `num_noti` = '0' WHERE `user_id` = '$user_id' AND `order_num`='$num';");
            } catch (\Throwable $th) {
                echo $th;
            }
        }elseif($row['num_noti']=='0'){
            try {
                mysqli_query($connect, "UPDATE `order_tb` SET `num_noti` = '1' WHERE `user_id` = '$user_id' AND `order_num`='$num';");
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        $array = array($num ,$row['num_noti']);
        print_r(json_encode($array));
    }else if($type=="cashin"){

        try {
            $sql = mysqli_query($connect, "SELECT `cashin_noti` FROM `cashin_tb` WHERE `cashin_id`='$num';");
            $row = mysqli_fetch_assoc($sql);
        } catch (\Throwable $th) {
            echo $th;
        }

        if($row['cashin_noti']=='1'){
            try {
                mysqli_query($connect, "UPDATE `cashin_tb` SET `cashin_noti` = '0' WHERE `user_id` = '$user_id' AND `cashin_id`='$num';");
            } catch (\Throwable $th) {
                echo $th;
            }
        }elseif($row['cashin_noti']=='0'){
            try {
                mysqli_query($connect, "UPDATE `cashin_tb` SET `cashin_noti` = '1' WHERE `user_id` = '$user_id' AND `cashin_id`='$num';");
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        $array = array($num ,$row['cashin_noti']);
        print_r(json_encode($array));
    }elseif($type=="sent"||$type=="receiver"){

        try {
            $sql = mysqli_query($connect, "SELECT `sendbalance_noti` FROM `sendbalance_tb` WHERE `sendBalance_id` = '$num';");
            $row = mysqli_fetch_assoc($sql);
        } catch (\Throwable $th) {
            echo $th;
        }

        if($row['sendbalance_noti']=='1'){
            try {
                mysqli_query($connect, "UPDATE `sendbalance_tb` SET `sendbalance_noti` = '0' WHERE `sendBalance_id`='$num';");
            } catch (\Throwable $th) {
                echo $th;
            }
        }elseif($row['sendbalance_noti']=='0'){
            try {
                mysqli_query($connect, "UPDATE `sendbalance_tb` SET `sendbalance_noti` = '1' WHERE `sendBalance_id`='$num';");
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        $array = array($num ,$row['sendbalance_noti']);
        print_r(json_encode($array));
    }
    
    
}

?>