<?php
require('Dbconnection.php');
if(isset($_POST['order_num'])){
    $order_num = $_POST['order_num'];
    try {
        $sql = mysqli_query($connect, "SELECT `orderproduct_name`, `order_quantity`, `order_amount`, `order_productcategory`, `order_num` FROM `order_tb` WHERE `order_num` = '$order_num';");
        $array_data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $array_data[] = array("orderproduct_name"=>$row['orderproduct_name'], "order_quantity"=>$row['order_quantity'], "order_amount"=>$row['order_amount'], "order_productcategory"=>$row['order_productcategory'], "order_num"=>$row['order_num']);
        }
        print_r(json_encode($array_data));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>