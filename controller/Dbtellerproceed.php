<?php 
session_start();
require('Dbconnection.php');
if(isset($_POST['order_ref'])){
    $order_ref = $_POST['order_ref'];
    $teller_id = $_SESSION['id'];

    try {
        $sql = mysqli_query($connect, "SELECT `order_id` FROM `order_tb` WHERE `order_num` = '$order_ref' AND `teller_id`='$teller_id' AND `statues` = 'ACCEPTED'");
        while($row = mysqli_fetch_assoc($sql)){
            $id = $row['order_id'];
            try {
                mysqli_query($connect, "UPDATE `order_tb` SET `statues`='PROCEED', `num_noti` = '0' WHERE `teller_id`='$teller_id' AND `order_num`='$order_ref' AND `order_id` = '$id';");
                echo "success";
            } catch (\Throwable $th) {
                echo $th;
            }
        }
    } catch (\Throwable $th) {
        echo $th;
    }
}


?>