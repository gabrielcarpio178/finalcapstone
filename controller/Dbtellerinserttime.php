<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['deadline'])&&isset($_POST['order_num'])&&isset($_POST['order_id'])){
    
    $new_datetime = $_POST['deadline'];
    $order_num = $_POST['order_num'];
    $order_id = $_POST['order_id'];
    $teller_id = $_SESSION['id'];

    try {
        $get_all_order = mysqli_query($connect, "SELECT order_id FROM order_tb WHERE order_num = '$order_num' AND teller_id = '$teller_id'");
        
    } catch (\Throwable $th) {
        echo $th;
    }

    $accepted_order = array();
    $declane_order = array();
    while($all_order = mysqli_fetch_assoc($get_all_order)){
        if($all_order['order_id']==$order_id){
            $accepted_order[] = $all_order['order_id'];
        }else{
            $declane_order[] = $all_order['order_id'];
        }
    }

    $i = 0;
    while(count($accepted_order)!=$i){
        try{
            mysqli_query($connect, "UPDATE `order_tb` set `deadline_time`='$new_datetime', `statues` = 'ACCEPTED', `num_noti` = '0' WHERE order_num = '$order_num' AND `teller_id` = '$teller_id' AND `order_id` = '$accepted_order[$i]';");
        }catch(\Throwable $th){
            echo $th;
        }
        
    
        try {
            $ordersql = mysqli_query($connect, "SELECT order_quantity, product_id FROM order_tb WHERE teller_id = '$teller_id' AND order_num = '$order_num' AND `order_id` = '$order_id';");
            $orderrow = mysqli_fetch_assoc($ordersql);
        } catch (\Throwable $th) {
            echo $th;
        }
    
        $product_id = $orderrow['product_id'];
        $order_quantity = $orderrow['order_quantity'];
    
        try {
            $qty_sql = mysqli_query($connect, "SELECT quantity FROM product_tb WHERE product_id = '$product_id' AND teller_id = '$teller_id';");
            $qty_row = mysqli_fetch_assoc($qty_sql);
        } catch (\Throwable $th) {
            echo $th;
        }
    
        $new_qty = $qty_row['quantity'] - $order_quantity;
    
        try {
            mysqli_query($connect, "UPDATE `product_tb` SET `quantity` = '$new_qty' WHERE product_id = '$product_id' AND teller_id = '$teller_id'");
        } catch (\Throwable $th) {
            echo $th;
        }
        $i++;
    }

    $x = 0;
    while(count($declane_order)!=$x){
        try{
            mysqli_query($connect, "UPDATE `order_tb` set `deadline_time`='$new_datetime', `statues` = 'DECLANE', `num_noti` = '0' WHERE order_num = '$order_num' AND `teller_id` = '$teller_id' AND `order_id` = '$declane_order[$x]';");
        }catch(\Throwable $th){
            echo $th;
        }
        $x++;
    }
}

?>
