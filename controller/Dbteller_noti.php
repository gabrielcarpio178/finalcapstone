<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['user_id'])){
    $teller_id = $_SESSION['id'];
    try {
        $sql_order = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, user_tb.image_profile, user_tb.gender, order_tb.order_amount, order_tb.order_time, order_tb.deadline_time, order_tb.num_noti, order_tb.statues, order_tb.order_id FROM order_tb INNER JOIN user_tb ON order_tb.user_id = user_tb.user_id WHERE order_tb.teller_id = '$teller_id';");
        $array_order = array();
        while($row_order = mysqli_fetch_assoc($sql_order)){
            $array_order[] = array("name"=>$row_order['firstname']." ".$row_order['lastname'], "order_amount"=>$row_order['order_amount'], "order_time"=>$row_order['order_time'], "deadline_time"=>$row_order['deadline_time'], "num_noti"=>$row_order['num_noti'], "isSeen"=>$row_order['num_noti'], "image_profile"=>$row_order['image_profile'], "gender"=>$row_order['gender'], "type"=>"order", "order_id"=>$row_order['order_id']);
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_cashou = mysqli_query($connect, "SELECT `cashout_amount`, `cashout_date`, `cashout_noti`, `cashout_id` FROM `cashout_tb` WHERE `cashout_status` = 'accepted' AND `teller_id` = '$teller_id';");
        $array_cashout = array();
        while($row_cashout = mysqli_fetch_assoc($sql_cashou)){
            $array_cashout[] = array("cashout_amount"=>$row_cashout['cashout_amount'], "order_time"=>$row_cashout['cashout_date'], "type"=>"cashout", "isSeen"=>$row_cashout['cashout_noti'], "order_id"=>$row_cashout['cashout_id']);
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    $array_data = array_merge($array_order, $array_cashout);
    print_r(json_encode($array_data));
}
?>