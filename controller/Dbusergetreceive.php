<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    try {
        $sql = mysqli_query($connect. "");
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>