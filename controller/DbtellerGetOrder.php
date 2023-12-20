<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['order_num'])){
    $order_num = $_POST['order_num'];
    $teller_id = $_SESSION['id'];
    try {
        $sql = mysqli_query($connect, "SELECT `order_id`, `orderproduct_name`, `order_quantity`, `order_amount`, `order_productcategory`, `order_num`, `statues` FROM `order_tb` WHERE `order_num` = '$order_num' AND `teller_id` = '$teller_id';");
        $array_data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $array_data[] = array("order_id"=>$row['order_id'], "orderproduct_name"=>$row['orderproduct_name'], "order_quantity"=>$row['order_quantity'], "order_amount"=>$row['order_amount'], "order_productcategory"=>$row['order_productcategory'], "order_num"=>$row['order_num'], "statues"=>$row['statues']);
        }
        print_r(json_encode($array_data));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>