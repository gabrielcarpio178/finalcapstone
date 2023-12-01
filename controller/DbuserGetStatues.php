<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['user_id'])){
    $id = $_POST['user_id'];
    try {
        $sql = mysqli_query($connect, "SELECT `statues` FROM user_tb WHERE `user_id` = '$id';");
        $row = mysqli_fetch_assoc($sql);
        $array_info = array('statues'=>$row['statues'], "user"=>$id);
        print_r(json_encode($array_info));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>