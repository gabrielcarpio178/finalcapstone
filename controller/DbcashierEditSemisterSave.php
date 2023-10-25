<?php
require('Dbconnection.php');
if(isset($_POST['edit_year'])&&isset($_POST['semister_year'])){
    $year = $_POST['edit_year'];
    $semister = $_POST['semister_year'];

    try {
        $sql = mysqli_query($connect, "SELECT `semesterYear_id`, `semister`, `semister_start` FROM semesteryear_tb ORDER BY semesterYear_id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
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