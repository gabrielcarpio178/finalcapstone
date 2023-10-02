<?php
require('Dbconnection.php');
if(isset($_POST['rfid'])){
    $rfid = $_POST['rfid'];
    try {
        $sql = mysqli_query($connect, "SELECT user_id, rfid_number FROM student_tb WHERE rfid_number ='$rfid';");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if(!empty($row)){
        echo $row['user_id'];
    }else{
        echo "invalid-rfid";
    }
    
}
?>