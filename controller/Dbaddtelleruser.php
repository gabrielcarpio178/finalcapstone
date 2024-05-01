<?php 
require('Dbconnection.php');
require_once "../phpqrcode/qrlib.php";
sleep(1);
session_start();
if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['phonenumber'])&&isset($_POST['email'])&&isset($_POST['store_name'])&&isset($_POST['gender'])&&isset($_POST['username'])&&isset($_POST['password'])){

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

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];
    $store_name = $_POST['store_name'];
    $email = strtoupper($_POST['email']);
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = md5(strtolower( $_POST['password']));
    
    try {
        $select = mysqli_query($connect, "SELECT `user_category`, `username`, `password` FROM `user_tb` WHERE username='$username' OR password='$password' OR email  = '$email' UNION ALL SELECT `user_category`, `username`, `password` FROM `telleruser_tb` WHERE username='$username' OR password='$password' OR email  = '$email' UNION ALL SELECT `user_category`, `username`, `password` FROM `cashier_tb` WHERE username='$username' OR password='$password' OR email  = '$email' UNION ALL SELECT `user_category`, `username`, `password` FROM `admin_tb` WHERE username='$username' OR password='$password' OR email  = '$email';");    
        $row=mysqli_fetch_assoc($select);
        if(!empty($row)){
        echo "invalidinput"; 
        }else{

            $path = "../users/teller/tellerqrimage/";
            $qrkey = generate_key($connect);
            $qr = $path.$qrkey.".png";
            $qrnamimage = $qrkey.".png";
            QRcode :: png($qrkey, $qr, 'H', 4, 4);
                        
            $user = mysqli_query($connect, "SELECT phonenumber FROM user_tb WHERE phonenumber = '$phonenumber';");    
            $userrow=mysqli_fetch_assoc($user);

            $teller = mysqli_query($connect, "SELECT phonenumber_teller FROM telleruser_tb WHERE phonenumber_teller = '$phonenumber';");    
            $tellerrow=mysqli_fetch_assoc($teller);

            if(!empty($userrow)||!empty($tellerrow)){

                echo "contact_already_used";

            }else{

                mysqli_query($connect,"INSERT INTO `telleruser_tb`(`firstname_teller`, `lastname_teller`, `phonenumber_teller`, `store_name`, `teller_gender`, `user_category`, `email`, `teller_qr`, `tellerqr_image`, `username`, `password`) VALUES ('$firstname','$lastname','$phonenumber','$store_name', '$gender', 'teller', '$email', '$qrkey', '$qrnamimage','$username','$password');");
                echo "success";

            }
        }
    } catch (\Throwable $th) {
        echo $th;
    }

}

?>