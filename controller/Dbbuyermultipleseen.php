<?php
require('Dbconnection.php');
sleep(1);
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];

    try {
        $sql = mysqli_query($connect, "SELECT `num_noti`, `order_num` FROM `order_tb` WHERE `user_id` = '$user_id' AND `num_noti` = '0';");
    } catch (\Throwable $th) {
        echo $th;
    }

    $array = array();

    while($row = mysqli_fetch_assoc($sql)){
        try {
            mysqli_query($connect, "UPDATE `order_tb` SET `num_noti`='1' WHERE `user_id` = '$user_id' AND `num_noti` = '".$row['num_noti']."';");
        } catch (\Throwable $th) {
            echo $th;
        }
        $array[] = $row['order_num'];
    }
    print_r(json_encode($array));
}
?>