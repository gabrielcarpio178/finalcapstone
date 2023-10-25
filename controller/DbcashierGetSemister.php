<?php
require('Dbconnection.php');
if(isset($_POST['cashier'])){
    try {
        $sql = mysqli_query($connect, "SELECT `semister`, `semister_start` FROM semesteryear_tb ORDER BY semesterYear_id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($sql);
        print_r(json_encode($row));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>