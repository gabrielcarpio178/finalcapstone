<?php
require('Dbconnection.php');
if(isset($_POST['category_name'])&&isset($_POST['category_amount'])){
    $certificate_name = $_POST['category_name'];
    $certificate_amount = $_POST['category_amount'];
    $input_array = array_merge($certificate_name, $certificate_amount);
    $isEmpty = 1;
    foreach ($input_array as $input) {
        if($input==''){
            $isEmpty = 0;
            break;
        }
    }
    if($isEmpty!=0){
        for($i=0;$i<count($certificate_name);$i++){
            try {
                mysqli_query($connect, "INSERT INTO `cashierrates_tb`(`cashierRates_request`, `cashierRatesCertificate`, `cashierRates_amount`) VALUES ('certificate','$certificate_name[$i]','$certificate_amount[$i]')");
                echo "success";
            } catch (\Throwable $th) {
                echo $th;
            }
        }
    }else{
        echo "empty";
    }
    
}

?>