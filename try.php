<?php
require('controller/Dbconnection.php');
require_once "phpqrcode/qrlib.php";
function checkqr_num($connect, $qrnum){
        $getqrnum = mysqli_query($connect, "SELECT teller_qr FROM telleruser_tb;");
        while($row = mysqli_fetch_assoc($getqrnum)){
            if($row['teller_qr']==$qrnum){
                $uni = true;
                break;
            }else{
                $uni = false;
            }
        }
        return $uni;
    }

    function generate_key($connect){
        $keylength = 8;
        $str = "1234567890";
        $randomkey = substr(str_shuffle($str), 0, $keylength);
        
        $checkkey = checkqr_num($connect, $randomkey);

        while($checkkey == true){
            $randomkey = substr(str_shuffle($str), 0, $keylength);
            $checkkey = checkqr_num($connect, $randomkey);
        }

        return $randomkey;
    }

    $path = "users";
    $qrkey = generate_key($connect);
    $qr = $path.$qrkey.".png";
    $qrnamimage = $qrkey.".png";
    QRcode :: png($qrkey, $qr, 'H', 4, 4);

?>