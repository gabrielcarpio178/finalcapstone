<?php
require('Dbconnection.php');
if(isset($_POST['cashier'])){
    try {
        $sql = mysqli_query($connect, "SELECT `cashierRates_id`, `cashierRates_request`, `cashierRatesCertificate`, `cashierRates_amount` FROM `cashierrates_tb`;");
        $array = array();
        while($row = mysqli_fetch_assoc($sql)){
            $array[] = array("cashierRates_id"=>$row['cashierRates_id'],"cashierRates_request"=>$row['cashierRates_request'], "cashierRatesCertificate"=>ucfirst($row['cashierRatesCertificate']),"cashierRates_amount"=>$row['cashierRates_amount']);
        }
        print_r(json_encode($array));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>