<?php
require('Dbconnection.php');

if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    try {
        $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, user_tb.email, user_tb.phonenumber, user_tb.usertype, student_tb.studentID_number, personnel_tb.personnelUser_id, student_tb.rfid_number, user_tb.gender, student_tb.course, personnel_tb.department, student_tb.year, user_tb.address FROM user_tb LEFT JOIN student_tb ON student_tb.user_id = user_tb.user_id LEFT JOIN personnel_tb ON personnel_tb.user_id = user_tb.user_id WHERE user_tb.user_id='$user_id';");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_totalPurchase =  mysqli_query($connect, "SELECT SUM(order_tb.order_amount) AS total_purchase, order_tb.user_id, order_tb.`statues` FROM order_tb WHERE order_tb.user_id = '$user_id' GROUP BY order_tb.`statues`;");
        
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_totalCashin = mysqli_query($connect, "SELECT SUM(cashin_amount) AS total_cashin, user_id FROM cashin_tb WHERE user_id = '$user_id' GROUP BY user_id;");

    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_total_payment = mysqli_query($connect,"SELECT SUM(payment_amount) AS total_payment, user_id FROM digitalpayment_tb WHERE user_id = '$user_id' GROUP BY user_id;");
    } catch (\Throwable $th) {
        echo $th;
    }

    $total_cashin_user = 0;
    $total_purchase_user = 0;
    $total_payment_user = 0;

    while($total_purchase = mysqli_fetch_assoc($sql_totalPurchase)){
        if($total_purchase['statues']!="CANCELED"){
            $total_purchase_user += $total_purchase['total_purchase'];
        }
    }
    
    while($total_cashin = mysqli_fetch_assoc($sql_totalCashin)){
        $total_cashin_user = $total_cashin['total_cashin'];
    }

    while($total_payment = mysqli_fetch_assoc($sql_total_payment)){
        $total_payment_user = $total_payment['total_payment'];
    }

    $row['user_balance'] = $total_cashin_user - ($total_purchase_user+$total_payment_user);
    print_r(json_encode($row));
}

?>