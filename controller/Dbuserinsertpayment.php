<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])&&isset($_POST['input_amount'])&&isset($_POST['type_payment'])){
    $user_id = $_POST['user_id'];
    $input_amount = $_POST['input_amount'];
    $type_payment = $_POST['type_payment'];
    try {
        mysqli_query($connect, "INSERT INTO `digitalpayment_tb`(`user_id`, `payment_amount`, `payment_type`, `requestType`) VALUES ('$user_id','$input_amount','$type_payment', 'pending')");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>