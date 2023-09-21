<?php
session_start();
sleep(1);
require('Dbconnection.php');
if(isset($_POST['category_id'])&&isset($_POST['category_name'])){
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    try{
        mysqli_query($connect, "UPDATE `category_tb` SET `category_name`='$category_name' WHERE `category_id`='$category_id';");
        echo "success";
    }catch(\Throwable $th){
        echo $th;
    }
}else{
    echo "empty";
}
?>
