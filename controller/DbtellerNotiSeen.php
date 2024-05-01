<?php
require('Dbconnection.php');
if(isset($_POST['id'])&&isset($_POST['type_info'])){
    $id = $_POST['id'];
    $type_info = $_POST['type_info'];
    if($type_info=='order'){
        try {
            $sql_order = mysqli_query($connect, "SELECT num_noti FROM order_tb WHERE order_id = '$id';");
            $row_order = mysqli_fetch_assoc($sql_order);
        } catch (\Throwable $th) {
            echo $th;
        }
        if($row_order['num_noti']=='0'){
            try {
                mysqli_query($connect, "UPDATE `order_tb` SET `num_noti`='1' WHERE `order_id`='$id'");
                echo "success";
            } catch (\Throwable $th) {
                echo $th;
            }
        }else{
            try {
                mysqli_query($connect, "UPDATE `order_tb` SET `num_noti`='0' WHERE `order_id`='$id'");
                echo "success";
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        
    }else{
        try {
            $sql_cashout = mysqli_query($connect, "SELECT cashout_noti FROM cashout_tb WHERE cashout_id = '$id';");
            $row_cashout = mysqli_fetch_assoc($sql_cashout);
        } catch (\Throwable $th) {
            echo $th;
        }
        if($row_cashout['cashout_noti']=="0"){
            try {
                mysqli_query($connect, "UPDATE `cashout_tb` SET `cashout_noti`='1' WHERE `cashout_id`='$id';");
                echo "success";
            } catch (\Throwable $th) {
                echo $th;
            }
        }else{
            try {
                mysqli_query($connect, "UPDATE `cashout_tb` SET `cashout_noti`='0' WHERE `cashout_id`='$id';");
                echo "success";
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        
    }
}
?>