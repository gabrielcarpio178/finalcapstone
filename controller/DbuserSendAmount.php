<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['inputed_balance'])&&isset($_POST['sendToId'])){
    $sender = $_SESSION['id'];
    $receiver = $_POST['sendToId'];
    $amount = $_POST['inputed_balance'];

    function checkpersonnelUser_num($connect, $ref_num){
        $getqrnum = mysqli_query($connect, "SELECT `sendBalance_ref` FROM `sendbalance_tb`;");
        $uni = false;
        while($row = mysqli_fetch_assoc($getqrnum)){
            if($row['sendBalance_ref']==$ref_num){
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
        mysqli_query($connect, "INSERT INTO `sendbalance_tb`(`sender_id`, `receiver_id`, `send_amount`, `sendBalance_ref`) VALUES ('$sender','$receiver','$amount','$uniq');");
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, sendbalance_tb.sendBalance_ref, sendbalance_tb.send_amount, sendbalance_tb.sendBalance_Date FROM user_tb INNER JOIN sendbalance_tb ON user_tb.user_id = sendbalance_tb.receiver_id WHERE sendbalance_tb.sendBalance_ref = '$uniq';");
        $row = mysqli_fetch_assoc($sql);
        print_r(json_encode($row));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>