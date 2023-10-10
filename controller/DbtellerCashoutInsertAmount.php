<?php
require('Dbconnection.php');
if(isset($_POST['amount'])&&isset($_POST['user_id'])){
    $amount = $_POST['amount'];
    $user_id = $_POST['user_id'];

    function checkpersonnelUser_num($connect, $ref_num){
        $getqrnum = mysqli_query($connect, "SELECT `cashout_refnum` FROM `cashout_tb`;");
        $uni = false;
        while($row = mysqli_fetch_assoc($getqrnum)){
            if($row['cashout_refnum']==$ref_num){
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
        mysqli_query($connect, "INSERT INTO `cashout_tb`(`teller_id`, `cashout_amount`, `cashout_refnum`) VALUES ('$user_id','$amount','$uniq')");
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_data = mysqli_query($connect, "SELECT `cashout_date`, `cashout_amount`, `cashout_refnum` FROM `cashout_tb` WHERE `cashout_refnum`='$uniq';");
        $result = mysqli_fetch_assoc($sql_data);
        print_r(json_encode($result));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>