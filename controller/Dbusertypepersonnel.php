<?php
session_start();
require('Dbconnection.php');
sleep(1);
$id=$_POST['id_personnel'];;
$department=$_POST['department'];

function checkpersonnelUser_num($connect, $personnelUser_id){
  $getqrnum = mysqli_query($connect, "SELECT `personnelUser_id` FROM `personnel_tb`;");
  while($row = mysqli_fetch_assoc($getqrnum)){
      if($row['personnelUser_id']==$personnelUser_id){
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

  try{
    mysqli_query($connect, "INSERT INTO `personnel_tb`(`user_id`, `department`, `personnelUser_id`) VALUES ('$id','$department', '$uniq');");
    mysqli_query($connect,"UPDATE `user_tb` SET `usertype`='personnel' WHERE user_id='$id';");
    $getuserquery = mysqli_query($connect, "SELECT usertype, user_id FROM `user_tb` WHERE user_id = '$id'");
    $row = mysqli_fetch_assoc($getuserquery);
    $_SESSION['id']=$row['user_id'];
    $_SESSION['id']=$row['user_id'];
    $_SESSION['usertype']=$row['usertype']; 
    echo "success";
  }catch(\Throwable $th){
    echo $th;
  }
?>
