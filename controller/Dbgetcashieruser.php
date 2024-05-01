<?php
require('Dbconnection.php');
if(isset($_POST['cashier'])){
    try {
        $sql = mysqli_query($connect, "SELECT * FROM `cashier_tb`");
        $row = mysqli_fetch_assoc($sql);
        print_r(json_encode($row));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>