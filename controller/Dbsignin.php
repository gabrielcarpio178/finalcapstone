<?php
session_start();
sleep(1);
require('Dbconnection.php');
$username=$_POST['username'];
$password=md5($_POST['password']);
$_SESSION['error'] = array();

try{
   $result=mysqli_query($connect, "SELECT * FROM `user_tb` WHERE username='$username' AND password='$password';");
   $row = mysqli_fetch_assoc($result);
   if($row>0){ 
    $id = $row['user_id'];
      if($row['request']=="not-activite"){
        echo 'account_request';
      }
      elseif($row['usertype']==NULL){
        echo 'firstlogin';
         $_SESSION['id']=$row['user_id']; 
         $_SESSION['firstname']=$row['firstname'];        
         $_SESSION['gender'] = $row['gender'];  
        }else{
            $_SESSION['id']=$row['user_id'];
            $_SESSION['usertype'] = $row['usertype'];
            $_SESSION['firstname']=$row['firstname']; 
            $_SESSION['gender'] = $row['gender'];
            try {
              $sql_check = mysqli_query($connect, "SELECT `user_id` FROM `userwebusages_tb` WHERE `user_id`='$id' AND MONTH(`use_date`) LIKE MONTH(CAST(now() AS DATE)) AND `user_category`='user_buyer';");
              $check = mysqli_fetch_assoc($sql_check);
              if(empty($check)){
                try {
                  mysqli_query($connect, "INSERT INTO `userwebusages_tb`(`user_id`, `user_category`) VALUES ('$id', 'user_buyer');");
                  echo 'login';
                } catch (\Throwable $th) {
                  echo $th;
                }
              }else{
                echo 'login';
              }
            } catch (\Throwable $th) {
              echo $th;
            }

        }
        try {
          mysqli_query($connect, "UPDATE `user_tb` SET `statues`='active' WHERE `user_id` = '$id';");
        } catch (\Throwable $th) {
          echo $th;
        } 
  
        
        
    }
      //admin
      else{
          $admin=mysqli_query($connect, "SELECT * FROM `admin_tb` WHERE username='$username' AND password='$password';");
          $admin_row = mysqli_fetch_assoc($admin);
      if($admin_row>0){
          echo "admin";
          $_SESSION['id']=$admin_row['admin_id'];
          $_SESSION['usertype'] = $admin_row['user_category'];
          
        }
       else{
         //cashier
         $cashier=mysqli_query($connect, "SELECT * FROM `cashier_tb` WHERE username='$username' AND password='$password';");
         $cashier_row = mysqli_fetch_assoc($cashier);
         if($cashier_row>0){
          //print_r($cashier_row);
          $id = $cashier_row['cashier_id'];
           $_SESSION['id']=$cashier_row['cashier_id'];
           $_SESSION['usertype'] = $cashier_row['user_category'];
           try {
            $sql_check = mysqli_query($connect, "SELECT `user_id` FROM `userwebusages_tb` WHERE `user_id`='$id' AND MONTH(`use_date`) LIKE MONTH(CAST(now() AS DATE)) AND `user_category`='cashier';");
            $check = mysqli_fetch_assoc($sql_check);
            if(empty($check)){
              try {
                mysqli_query($connect, "INSERT INTO `userwebusages_tb`(`user_id`, `user_category`) VALUES ('$id', 'cashier');");
                echo "cashier";  
              } catch (\Throwable $th) {
                echo $th;
              }
            }else{
              echo "cashier";  
            }
          } catch (\Throwable $th) {
            echo $th;
          }
  
           }else{
             //teller
              $teller=mysqli_query($connect, "SELECT * FROM `telleruser_tb` WHERE username='$username' AND password='$password';");
              $teller_row = mysqli_fetch_assoc($teller);
           if($teller_row>0){
              $id = $teller_row['teller_id'];
              $_SESSION['id'] = $teller_row['teller_id'];            
              $_SESSION['teller_name'] = $teller_row['store_name'];
              $_SESSION['usertype'] = $teller_row['user_category'];
              $_SESSION['gender'] = $teller_row['teller_gender'];

              try {
                $sql_check = mysqli_query($connect, "SELECT `user_id` FROM `userwebusages_tb` WHERE `user_id`='$id' AND MONTH(`use_date`) LIKE MONTH(CAST(now() AS DATE)) AND `user_category`='teller';");
                $check = mysqli_fetch_assoc($sql_check);
                if(empty($check)){
                  try {
                    mysqli_query($connect, "INSERT INTO `userwebusages_tb`(`user_id`, `user_category`) VALUES ('$id', 'teller');");
                    echo "teller";  
                  } catch (\Throwable $th) {
                    echo $th;
                  }
                }else{
                  echo "teller";  
                }
              } catch (\Throwable $th) {
                echo $th;
              }
  
           }else{
             echo "wrong";
             //echo $password;
             }
           }
         }
      }
    }catch (\Throwable $th){
      echo $th;
    }
?>
