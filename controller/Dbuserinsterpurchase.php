<?php
session_start();
require('Dbconnection.php');
if(isset($_POST['teller_id'])&&isset($_POST['user_id'])&&isset($_POST['input_amount'])){
    $teller_id = $_POST['teller_id'];
    $user_id = $_POST['user_id'];
    $input_amount = $_POST['input_amount'];
    $uniq = uniqid($_SESSION['firstname'], true);
    try {
        mysqli_query($connect, "INSERT INTO `order_tb`(`user_id`, `teller_id`, `order_amount`, `order_num`, `statues`, `order_time`, `deadline_time`) VALUES ('$user_id','$teller_id','$input_amount','$uniq', 'PROCEED', NOW(), NOW())");
        echo $input_amount;
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>