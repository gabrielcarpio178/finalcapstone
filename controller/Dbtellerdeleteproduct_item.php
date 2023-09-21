<?php
require('Dbconnection.php');
sleep(1);
if(isset($_POST['item'])){
    $item = $_POST['item'];
    try {
        mysqli_query($connect, "DELETE FROM `product_tb` WHERE `product_id`='$item';");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>