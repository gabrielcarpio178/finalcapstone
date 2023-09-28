<?php
session_start();
require('Dbconnection.php');
if(isset($_POST['teller_id'])&&isset($_POST['user_id'])&&isset($_POST['input_amount'])){

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
    
    $teller_id = $_POST['teller_id'];
    $user_id = $_POST['user_id'];
    $input_amount = $_POST['input_amount'];
    $uniq = generate_key($connect);
    
    
    try {
        mysqli_query($connect, "INSERT INTO `order_tb`(`user_id`, `teller_id`, `order_amount`, `order_num`, `statues`, `order_time`, `deadline_time`, `num_noti`) VALUES ('$user_id','$teller_id','$input_amount','$uniq', 'PURCHASE', NOW(), NOW(), '0');");

        $sql = mysqli_query($connect, "SELECT order_tb.deadline_time, order_tb.order_num, order_tb.order_amount, telleruser_tb.store_name FROM order_tb INNER JOIN telleruser_tb ON order_tb.teller_id = telleruser_tb.teller_id WHERE order_tb.order_num = '$uniq';");
        $row = mysqli_fetch_assoc($sql);
        if(!empty($row)){
            print_r(json_encode($row));
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    
}
?>