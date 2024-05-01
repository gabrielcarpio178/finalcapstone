<?php 
require('Dbconnection.php');
if(isset($_POST['order_num'])){  
    $order_num = $_POST['order_num'];  
    try{
        $sql = mysqli_query($connect, "SELECT `orderproduct_name`, `order_productcategory`, `order_time`, `deadline_time`, `order_amount`, `order_quantity`, `statues`, `order_num` FROM `order_tb` WHERE `order_num` = '$order_num'");
        $array_result = array();
        while($row = mysqli_fetch_assoc($sql)){
            $array_result[] = array('orderproduct_name'=>$row['orderproduct_name'], 'order_productcategory'=>$row['order_productcategory'], 'order_time'=>$row['order_time'], 'statues'=>$row['statues'], 'order_amount'=>$row['order_amount'], 'order_quantity'=>$row['order_quantity']);
        }
        print_r(json_encode($array_result));
    }catch(\Throwable $th){
        echo $th;
    }
}

?>