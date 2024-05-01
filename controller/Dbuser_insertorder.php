<?php 
session_start();
require('Dbconnection.php');
sleep(1);
$total = count($_POST['user_id']);


function checkqr_num($connect, $qrnum){
    $getqrnum = mysqli_query($connect, "SELECT order_num FROM order_tb;");
    while($row = mysqli_fetch_assoc($getqrnum)){
        if($row['order_num']==$qrnum){
            $uni = true;
            break;
        }else{
            $uni = false;
        }
    }
    return $uni;
}

function generate_key($connect){
    $keylength = 10;
    $str = "1234567890";
    $randomkey = substr(str_shuffle($str), 0, $keylength);
    
    $checkkey = checkqr_num($connect, $randomkey);

    while($checkkey == true){
        $randomkey = substr(str_shuffle($str), 0, $keylength);
        $checkkey = checkqr_num($connect, $randomkey);
    }

    return $randomkey;
}

$uniq = generate_key($connect);

try{
    
    for($i = 0; $i<$total; $i++){
        $user_id = $_POST['user_id'][$i];
        $product_id = $_POST['product_id'][$i];
        $product_qty_amount = $_POST['qty'][$i] * $_POST['price'][$i];
        $qty = $_POST['qty'][$i];  
        $product_name =  $_POST['product_name'][$i]; 
        $teller_id =  $_POST['teller_id'][$i];
        $category =$_POST['category'][$i];     
        mysqli_query($connect, "INSERT INTO `order_tb`(`user_id`, `teller_id`, `product_id`, `orderproduct_name`, `order_productcategory`, `order_time`, `order_amount`, `order_quantity`, `order_num`) VALUES ('$user_id', '$teller_id', '$product_id', '$product_name', '$category', NOW(), '$product_qty_amount','$qty', '$uniq');");

    }
    echo "success";
}catch(\Throwable $th){
    echo $th;
}


?>
