<?php 
require('Dbconnection.php');
if(isset($_POST['user'])){
    try {
        $sql = mysqli_query($connect, "SELECT `cashierRatesCertificate` FROM `cashierrates_tb`;");
        $payment_array = array();
        while($row = mysqli_fetch_assoc($sql)){
            $payment_array[] = $row['cashierRatesCertificate'];
        }
        print_r(json_encode($payment_array));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>