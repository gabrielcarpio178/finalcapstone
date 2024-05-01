<?php
require('Dbconnection.php');
if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['gender'])&&isset($_POST['phone_number'])&&isset($_POST['email'])&&isset($_POST['address'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    try {
        mysqli_query($connect, "UPDATE `cashier_tb` SET `firstname_cashier`='$firstname',`lastname_cashier`='$lastname',`phonenumber`='$phone_number',`gender`='$gender',`address`='$address',`email`='$email';");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>