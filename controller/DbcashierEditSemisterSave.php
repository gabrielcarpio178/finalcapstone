<?php
require('Dbconnection.php');
if(isset($_POST['edit_year'])&&isset($_POST['semister_year'])){
    $year = $_POST['edit_year'];
    $semister = $_POST['semister_year'];

    try {
        $sql = mysqli_query($connect, "SELECT `semesterYear_id`, `semister`, `semister_start` FROM semesteryear_tb ORDER BY semesterYear_id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($sql);
        $semister_row = $row['semister_start'];
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_semister = mysqli_query($connect, "SELECT digitalPayment_id FROM `digitalpayment_tb` WHERE `payment_type` = 'Non Bago fee' AND (CAST(payment_date AS DATE) BETWEEN '$semister_row' AND CAST(NOW() AS DATE));");
    } catch (\Throwable $th) {
        echo $th;
    }

    while($semister_update = mysqli_fetch_assoc($sql_semister)){
        $digitalPayment_id = $semister_update['digitalPayment_id'];
        try {
            mysqli_query($connect, "UPDATE `digitalpayment_tb` SET `semister_year`='$semister' WHERE `digitalPayment_id` = '$digitalPayment_id';");
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    $id = $row['semesterYear_id'];
    try {
        mysqli_query($connect, "UPDATE `semesteryear_tb` SET `semister_start`='$year', `semister` = '$semister' WHERE semesterYear_id = '$id';");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }


}
?>