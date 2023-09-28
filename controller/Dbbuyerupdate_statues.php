<?php 
require('Dbconnection.php');
if(isset($_POST['id'])&&isset($_POST['order_num'])){
    $id = $_POST['id'];
    $order_num = $_POST['order_num'];
    try {
        $sql = mysqli_query($connect, "SELECT `num_noti` FROM `order_tb` WHERE `user_id` = '$id' AND `order_num` = '$order_num';");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row['num_noti']=='1'){
        try {
            mysqli_query($connect, "UPDATE `order_tb` SET `num_noti` = '0' WHERE `user_id` = '$id' AND `order_num`='$order_num';");
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($row['num_noti']=='0'){
        try {
            mysqli_query($connect, "UPDATE `order_tb` SET `num_noti` = '1' WHERE `user_id` = '$id' AND `order_num`='$order_num';");
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    $array = array($order_num ,$row['num_noti']);
    print_r(json_encode($array));
    
}

?>