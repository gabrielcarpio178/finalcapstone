<?php
require('Dbconnection.php');
session_start();
sleep(1);
if(isset($_POST['input_post'])&&isset($_POST['post_to'])){
    $input = $_POST['input_post'];
    $post_to = $_POST['post_to'];

    try {
        mysqli_query($connect, "UPDATE `adminannoucement` SET `posted`='not-active';");
        mysqli_query($connect, "INSERT INTO `adminannoucement`( `post`, `post_date`, `post_type`, `posted`) VALUES ('$input',NOW(),'$post_to', 'active');");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>