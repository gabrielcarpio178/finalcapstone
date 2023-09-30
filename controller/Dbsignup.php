<?php
sleep(1);
require('Dbconnection.php');
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$phonenumber=$_POST['phonenumber'];
$gender=$_POST['gender'];
$address=$_POST['address'];
$username=$_POST['username'];
$password=md5($_POST['password']);

try{
    
    $select = mysqli_query($connect, "SELECT `user_category`, `username`, `password` FROM `user_tb` WHERE username='$username' OR password='$password' UNION ALL SELECT `user_category`, `username`, `password` FROM `telleruser_tb` WHERE username='$username' OR password='$password' UNION ALL SELECT `user_category`, `username`, `password` FROM `cashier_tb` WHERE username='$username' OR password='$password' UNION ALL SELECT `user_category`, `username`, `password` FROM `admin_tb` WHERE username='$username' OR password='$password';");    
        $row=mysqli_fetch_assoc($select);
    if(!empty($row)){
       echo "invalidinput"; 
    }else{
                       
        $user = mysqli_query($connect, "SELECT phonenumber FROM user_tb WHERE phonenumber = '$phonenumber' OR email = '$email';");    
        $userrow=mysqli_fetch_assoc($user);

        $teller = mysqli_query($connect, "SELECT phonenumber_teller FROM telleruser_tb WHERE phonenumber_teller = '$phonenumber';");    
        $tellerrow=mysqli_fetch_assoc($teller);

        if(!empty($userrow)||!empty($tellerrow)){

            echo "contact_already_used";

        }else{

            mysqli_query($connect,"INSERT INTO `user_tb`(`firstname`, `lastname`, `email`, `phonenumber`, `gender`, `address`, `user_category`, `request`, `statues`,`username`, `password`) VALUES ('$firstname','$lastname','$email','$phonenumber', '$gender', '$address', 'user_buyer', 'Activite', 'NULL', '$username','$password');");
            echo "success";

        }
    
    }
    
}catch(\Throwable $th){
    echo $th;
}
    
?>
