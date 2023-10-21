<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $isInbago = 'unpaid';
    try {
        $sql = mysqli_query($connect, "SELECT `address` FROM `user_tb` WHERE `user_id` = '$user_id';");
        $row = mysqli_fetch_assoc($sql);
        if($row['address']=='bago'){
            $isInbago = 'paid';
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    if($isInbago=='unpaid'){
        try {
            $sql_ispaid = mysqli_query($connect, "SELECT COUNT(`payment_type`) AS isPaid FROM `digitalpayment_tb` WHERE `user_id` = '$user_id' AND `payment_type` = 'Non Bago fee';");
            $ispaid = mysqli_fetch_assoc($sql_ispaid);
            if($ispaid['isPaid']==1){
                $isInbago = 'paid';
            }else{
                $isInbago = 'unpaid';
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    echo $isInbago;
}
?>