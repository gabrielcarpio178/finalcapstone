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
    
    
}
?>