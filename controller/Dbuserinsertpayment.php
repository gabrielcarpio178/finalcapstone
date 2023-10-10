<?php
require('Dbconnection.php');
sleep(1);
if(isset($_POST['user_id'])&&isset($_POST['input_amount'])&&isset($_POST['type_payment'])){
    $user_id = $_POST['user_id'];
    $input_amount = $_POST['input_amount'];
    $type_payment = $_POST['type_payment'];
    function checkpersonnelUser_num($connect, $ref_num){
        $getqrnum = mysqli_query($connect, "SELECT `payment_ref` FROM `digitalpayment_tb`;");
        $uni = false;
        while($row = mysqli_fetch_assoc($getqrnum)){
            if($row['payment_ref']==$ref_num){
                $uni = true;
                break;
            }else{
                $uni = false;
            }
        }
        return $uni;
    }

    function generate_key($connect){
        $keylength = 10;
        $str = "1234567890";
        $randomkey = substr(str_shuffle($str), 0, $keylength);
        
        $checkkey = checkpersonnelUser_num($connect, $randomkey);

        while($checkkey == true){
            $randomkey = substr(str_shuffle($str), 0, $keylength);
            $checkkey = checkqr_num($connect, $randomkey);
        }

        return $randomkey;
    }
    $uniq = generate_key($connect);

    try {
        mysqli_query($connect, "INSERT INTO `digitalpayment_tb`(`user_id`, `payment_amount`, `payment_type`, `requestType`, `payment_ref`) VALUES ('$user_id','$input_amount','$type_payment', 'pending', '$uniq')");
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql = mysqli_query($connect, "SELECT `payment_amount`, `payment_type`, `payment_ref`, `payment_date` FROM `digitalpayment_tb` WHERE `payment_ref`='$uniq';");
        $result = mysqli_fetch_assoc($sql);
        print_r(json_encode($result));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>