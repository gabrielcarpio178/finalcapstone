<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['year'])&&isset($_POST['gender'])&&isset($_POST['email'])&&isset($_POST['p_num'])&&(isset($_FILES['upload_profile']['name'])||!isset($_FILES['upload_profile']['name']))){
    $id = $_SESSION['id'];
    $usertype = $_SESSION['usertype'];
    $firstname = strtoupper($_POST['firstname']);
    $lastname  = strtoupper($_POST['lastname']);
    $year  = $_POST['year'];
    $gender  = $_POST['gender'];
    $email  = strtoupper($_POST['email']);
    $p_num  = $_POST['p_num'];
    
    try {
        $sql_email = mysqli_query($connect, "SELECT email FROM user_tb WHERE user_id='$id';");
        $row_email = mysqli_fetch_assoc($sql_email);
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_email_set = mysqli_query($connect, "SELECT `email` FROM `user_tb` UNION ALL SELECT `email` FROM `telleruser_tb` UNION ALL SELECT `email` FROM `cashier_tb` UNION ALL SELECT `email` FROM `admin_tb`;");
        $email_set = array();
        while ($row_email_set = mysqli_fetch_assoc($sql_email_set)) {
            $email_set[] = $row_email_set['email'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    $array_email_key = array_keys($email_set, $row_email['email']);
    $email_set = array_diff($email_set, array($row_email['email']));
    
    $i=0;
    $isValid = false;
    while(count($email_set)>$i) {
        if($array_email_key[0]!=$i){
            if($email_set[$i]==$email){
                $isValid = true;
            }
        }
        $i++;
    }
    if($isValid!=true){
        if($usertype=='student'){
            if(!empty($_FILES['upload_profile']['name'])){
                $imageName = $_FILES['upload_profile']['name'];
                $tmpName = $_FILES['upload_profile']['tmp_name'];
                $validImageExtension = ['jpg', 'jpeg', 'png'];
                $imageExtension = explode('.',$imageName);
                $name = $imageExtension[0];
                $imageExtension = strtolower(end($imageExtension));
                if(!in_array($imageExtension, $validImageExtension)){
                    echo "not_image";       
                }else{
                    $newNameImage = $name."-".uniqid();
                    $newNameImage .= ".".$imageExtension;
                    move_uploaded_file($tmpName, "../users/user_buyer/profile/".$newNameImage);
                    try {
                        mysqli_query($connect, "UPDATE `user_tb` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email', `phonenumber`='$p_num', `gender`= '$gender' , `image_profile` = '$newNameImage' WHERE `user_id` = '$id';");
                        echo "success";
                    } catch (\Throwable $th) {
                        echo $th;
                    }
                }
            }else{
                try {
                    mysqli_query($connect, "UPDATE `user_tb` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email', `phonenumber`='$p_num', `gender`= '$gender' WHERE `user_id` = '$id';");
                    echo "success";
                } catch (\Throwable $th) {
                    echo $th;
                }
            }
            
        }
    }else {
        echo "email_isInvalid";
    }

    
    
    
}
?>