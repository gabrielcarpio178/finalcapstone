<?php
require("Dbconnection.php");
sleep(1);
if(isset($_POST['amount'])&&isset($_POST['user_id'])){
    $amount = $_POST['amount'];
    $user_id = $_POST['user_id'];

    function checkpersonnelUser_num($connect, $ref_num){
        $getqrnum = mysqli_query($connect, "SELECT `ref_num` FROM `cashin_tb`;");
        while($row = mysqli_fetch_assoc($getqrnum)){
            if($row['ref_num']==$ref_num){
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
        mysqli_query($connect, "INSERT INTO `cashin_tb`(`user_id`, `cashin_amount`, `ref_num`) VALUES ('$user_id','$amount', '$uniq');");
        echo $uniq;
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>