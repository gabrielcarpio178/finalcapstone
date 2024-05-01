<?php
require('Dbconnection.php');
sleep(1);
if(isset($_POST['id'])){
    $id = $_POST['id'];
    try {
        mysqli_query($connect, "DELETE FROM `adminannoucement` WHERE announcement_id='$id';");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>