<?php
require('Dbconnection.php');
if(isset($_POST['user'])){
    try {
        $sql = mysqli_query($connect, "SELECT `cashierRates_id`, `cashierRates_request`,`cashierRatesCertificate`, `cashierRates_amount` FROM `cashierrates_tb`;");
        $array_categories = array();
        while($row = mysqli_fetch_assoc($sql)){
            $array_categories[] = array('cashierRates_id'=>$row['cashierRates_id'],'cashierRates_request'=>$row['cashierRates_request'], 'cashierRatesCertificate'=>$row['cashierRatesCertificate'], 'cashierRates_amount'=>$row['cashierRates_amount']);
        }
        print_r(json_encode($array_categories));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>