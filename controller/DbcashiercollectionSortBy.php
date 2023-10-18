<?php
require('Dbconnection.php');
if(isset($_POST['sortBy'])){
    try {
        $sql = mysqli_query($connect, "SELECT `cashierRatesCertificate` FROM `cashierrates_tb` WHERE `cashierRatesCertificate` != 'Non Bago Fee' AND `cashierRatesCertificate` != 'Transcript of Record';");
        $array = array();
        while($row = mysqli_fetch_assoc($sql)){
            $array[] = array('cashierRatesCertificate'=>$row['cashierRatesCertificate']);
        }
        print_r(json_encode($array));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>