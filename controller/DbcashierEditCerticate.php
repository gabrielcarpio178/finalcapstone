<?php
require('Dbconnection.php');
if(isset($_POST['category_id'])&&isset($_POST['category_name'])&&isset($_POST['category_amount'])){
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $category_amount = $_POST['category_amount'];
    $input_array = array_merge($category_name, $category_amount);
    $isEmpty = 1;
    foreach ($input_array as $input) {
        if($input==''){
            $isEmpty = 0;
            break;
        }
    }
    if($isEmpty!=0){
        for($i = 0;$i<count($category_id);$i++){
            if($category_name[$i]=="Non Bago Fee"||$category_name[$i]=="Certificate  of Transfers"){

                try {
                    mysqli_query($connect, "UPDATE `cashierrates_tb` SET `cashierRates_amount`='$category_amount[$i]' WHERE `cashierRates_id`='$category_id[$i]';");
                } catch (\Throwable $th) {
                    echo $th;
                }

            }else{

                try {
                    mysqli_query($connect, "UPDATE `cashierrates_tb` SET `cashierRatesCertificate`='$category_name[$i]',`cashierRates_amount`='$category_amount[$i]' WHERE `cashierRates_id`='$category_id[$i]';");
                } catch (\Throwable $th) {
                    echo $th;
                }

            }
            
        }
        echo "success";
    }else{
        echo "empty";
    }
    
}
?>