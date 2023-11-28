<?php
require('Dbconnection.php');
if(isset($_POST['email_input'])){
    $email_input = strtoupper($_POST['email_input']);
    $isvalid = false;
    try {
        $sql_userBuyer = mysqli_query($connect, "SELECT user_id, usertype FROM user_tb WHERE email='$email_input';");
        $row_sql_userBuyer = mysqli_fetch_assoc($sql_userBuyer);
        $count_sql_userBuyer  = mysqli_num_rows($sql_userBuyer);
        if($count_sql_userBuyer==1){
            $getdata = array('id'=>$row_sql_userBuyer['user_id'], 'user_buyer'=>$row_sql_userBuyer['usertype']);
            $isvalid = true;
        }else{
            try {
                $sql_emailCanteen  =  mysqli_query($connect, "SELECT teller_id, user_category FROM telleruser_tb WHERE email='$email_input';");
                $row_sql_emailCanteen  = mysqli_fetch_assoc($sql_emailCanteen);
                $count_sql_emailCanteen  = mysqli_num_rows($sql_emailCanteen);
                if($count_sql_emailCanteen==1){
                    $getdata = array('id'=>$row_sql_emailCanteen['teller_id'], 'user_buyer'=>$row_sql_emailCanteen['user_category']);
                    $isvalid = true;
                }else{
                    $isvalid = false;
                }
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        
    } catch (\Throwable $th) {
        echo $th;
    }
    if($isvalid == true){

        $id = $getdata['id'];
        $user_buyer = $getdata['user_buyer'];
        if($user_buyer=='personnel'||$user_buyer=='student'){

            try {
                $sql = mysqli_query($connect, "SELECT `password` FROM `user_tb` WHERE `user_id`='$id';");
                $row = mysqli_fetch_assoc($sql);
            } catch (\Throwable $th) {
                echo $th;
            }
            $result = str_split($row['password']);

        }elseif($user_buyer=='teller'){

            try {
                $sql = mysqli_query($connect, "SELECT `password` FROM `telleruser_tb` WHERE `teller_id`='$id';");
                $row = mysqli_fetch_assoc($sql);
            } catch (\Throwable $th) {
                echo $th;
            }
            $result = str_split($row['password']);

        }

        $letters = range('a', 'z');
        // $numbers = range('0', '9');
        $array_letters = array();
        $array_numbers = array();
        for($a = 0; $a < count($result) ; $a++){
            $x = false;
            for($i = 0; $i < count($letters); $i++){
            if($result[$a]==$letters[$i]){
                $x = true;          
            }
            }
            if($x==true){
                array_push($array_letters, $result[$a]); 
                $x = false;
            }else{
                array_push($array_numbers, $result[$a]);  
                $x = false;
            }
            
        }

        $reset_code = implode("",array_slice($array_numbers, 0, 10));
        echo $reset_code;

    }else{
        echo "invalid";
    }


}
?>