<?php
require("Dbconnection.php");
if(isset($_POST['amount'])&&isset($_POST['teller_id'])&&isset($_POST['password'])){
    $amount = $_POST['amount'];
    $teller_id = $_POST['teller_id'];
    $password = md5($_POST['password']);
    try {
        $getpassword = mysqli_query($connect, "SELECT password FROM telleruser_tb WHERE teller_id = '$teller_id';");
        $rowpassword = mysqli_fetch_assoc($getpassword);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($rowpassword['password']==$password){
        function checkqr_num($connect, $refnum){
            $getrefnum = mysqli_query($connect, "SELECT cashout_refnum FROM cashout_tb;");
            $row = mysqli_fetch_assoc($getrefnum);
            if(!empty($row)){
                do{
                    if($row['cashout_refnum']==$refnum){
                        $uni = true;
                        break;
                    }else{
                        $uni = false;
                    }
                }while($row = mysqli_fetch_assoc($getrefnum));
            }
            else{
                $uni = false;
            }
            return $uni;
        }

        function generate_key($connect){
            $keylength = 10;
            $str = "1234567890";
            $randomkey = substr(str_shuffle($str), 0, $keylength);
            
            $checkkey = checkqr_num($connect, $randomkey);

            while($checkkey == true){
                $randomkey = substr(str_shuffle($str), 0, $keylength);
                $checkkey = checkqr_num($connect, $randomkey);
            }

            return $randomkey;
        }

        $refkey = generate_key($connect);
        date_default_timezone_set("Asia/Manila"); 
        $new_datetime = date("Y-m-d h:i:s");
        $array = $_POST;
        $array['refnum'] = $refkey;
        $array['date'] = $new_datetime;
        try {
            mysqli_query($connect, "INSERT INTO `cashout_tb`(`teller_id`, `cashout_amount`, `cashout_refnum`) VALUES ('$teller_id' ,'$amount', '$refkey');");
            print_r(json_encode($array));
        } catch (\Throwable $th) {
            echo $th;
        }

    }else{
        echo "wrong";
    }
}
?>