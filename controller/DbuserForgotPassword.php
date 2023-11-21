<?php
require('Dbconnection.php');
if(isset($_POST['email_input'])){
    $email_input = strtoupper($_POST['email_input']);
    try {
        $sql_userBuyer = mysqli_query($connect, "SELECT user_id, usertype FROM user_tb WHERE email='$email_input';");
        $row_sql_userBuyer = mysqli_fetch_assoc($sql_userBuyer);
        $count_sql_userBuyer  = mysqli_num_rows($sql_userBuyer);
        if($count_sql_userBuyer==1){
            $getdata = array('id'=>$row_sql_userBuyer['user_id'], 'usertype'=>$row_sql_userBuyer['usertype']);
            print_r(json_encode($getdata));
        }else{
            try {
                $sql_emailCanteen  =  mysqli_query($connect, "SELECT teller_id, user_category FROM telleruser_tb WHERE email='$email_input';");
                $row_sql_emailCanteen  = mysqli_fetch_assoc($sql_emailCanteen);
                $count_sql_emailCanteen  = mysqli_num_rows($sql_emailCanteen);
                if($count_sql_emailCanteen==1){
                    $getdata = array('id'=>$row_sql_emailCanteen['teller_id'], 'usertype'=>$row_sql_emailCanteen['user_category']);
                    print_r(json_encode($getdata));
                }else{
                    echo 'invalid';
                }
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>