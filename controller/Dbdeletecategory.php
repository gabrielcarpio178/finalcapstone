<?php
require('Dbconnection.php');
sleep(1);
if(isset($_POST['category_id'])){
    $category_id = $_POST['category_id'];
    try {
        mysqli_query($connect, " DELETE FROM `category_tb` WHERE `category_id` = '$category_id';
        ");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>