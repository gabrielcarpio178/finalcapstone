<?php 
session_start();
require('Dbconnection.php');
print_r($_POST);
if(isset($_POST['order_ref'])){
    $order_ref = $_POST['order_ref'];
    $teller_id = $_SESSION['id'];
    try {
        mysqli_query($connect, "UPDATE `order_tb` SET `statues`='PROCEED' WHERE `teller_id`='$teller_id' AND `order_num`='$order_ref';");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}


?>