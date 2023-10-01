<?php
require('Dbconnection.php');
if(isset($_POST['rfid'])){
    $rfid = $_POST['rfid'];
    try {
        $sql = mysqli_query($connect, "SELECT user_tb.user_id, student_tb.rfid_number FROM user_tb INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    echo $row['user_id'];
}
?>