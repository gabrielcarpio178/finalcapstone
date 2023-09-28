<?php
require('Dbconnection.php');
session_start();
// print_r($_POST);
if(isset($_POST['deadline'])&&isset($_POST['order_date'])){;
    $new_datetime = $_POST['deadline'];
    $order_date = $_POST['order_date'];
    $id = $_SESSION['id'];
    try{
        mysqli_query($connect, "UPDATE `order_tb` set `deadline_time`='$new_datetime', `statues` = 'ACCEPTED', `num_noti` = '0' WHERE order_time = '$order_date' AND `teller_id` = '$id';");
        echo $new_datetime;
    }catch(\Throwable $th){
        echo $th;
    }
    
    $datetime = $_POST['order_date'];
    $teller_id = $_SESSION['id'];

    try {
        $ordersql = mysqli_query($connect, "SELECT order_quantity, order_time, user_id, product_id FROM order_tb WHERE teller_id = '$teller_id' AND order_time = '$datetime';");
        $orderrow = mysqli_fetch_assoc($ordersql);    
        
    } catch (\Throwable $th) {
        echo $th;
    }

    $order_product_id = array();
    $order_quantity = array();
    do{
        $order_quantity[] = $orderrow['order_quantity'];
        $order_product_id[] = $orderrow['product_id'];
    }while($orderrow = mysqli_fetch_array($ordersql));

    
    try {
        $sqlselectall = mysqli_query($connect, "SELECT product_id, quantity FROM product_tb WHERE teller_id = '$teller_id';");
        $selectallrow = mysqli_fetch_assoc($sqlselectall);
    } catch (\Throwable $th) {
        echo $th;
    }

    $allproduct_id = array();
    $allqty = array();
    do{
        $allproduct_id[] = $selectallrow['product_id'];
        $allqty[] = $selectallrow['quantity'];
    }while($selectallrow = mysqli_fetch_array($sqlselectall));
    
    $num_of_product = count($allproduct_id);
    $num_of_order = count($order_product_id);

    for($x = 0; $x < $num_of_order; $x++){
        for($i = 0; $i < $num_of_product; $i++){
            if($order_product_id[$x]==$allproduct_id[$i]){
                $_product_id = $order_product_id[$x];
                $result = $allqty[$i] - $order_quantity[$x];

                try {
                    mysqli_query($connect, "UPDATE `product_tb` SET `quantity`='$result' WHERE product_id = '$_product_id' AND teller_id = '$teller_id';");
                } catch (\Throwable $th) {
                    throw $th;
                }

            }
        
        }           
    }

    try {
        mysqli_query($connect, "UPDATE `order_tb` SET `statues`='ACCEPTED' WHERE `teller_id`='$teller_id' AND `order_time`='$datetime';");
    } catch (\Throwable $th) {
        echo $th;
    }


}

?>
