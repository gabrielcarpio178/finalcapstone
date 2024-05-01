<?php
require('Dbconnection.php');
session_start();
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
        // move_uploaded_file($tmpName, "../users/user_buyer/profile/".$newNameImage);
        // try {
        //     mysqli_query($connect, "UPDATE `user_tb` SET `image_profile` = '$newNameImage' WHERE `user_id` = '$id';");
        //     echo "success";
        // } catch (\Throwable $th) {
        //     echo $th;
        // }
    }
}
?>