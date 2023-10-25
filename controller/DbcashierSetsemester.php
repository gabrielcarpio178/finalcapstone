<?php
require('Dbconnection.php');
if(isset($_POST['sem_year'])){
    $sem_year = $_POST['sem_year'];
    $isNotEmpty = false;
    try {
        $sql = mysqli_query($connect, "SELECT semesterYear_id FROM semesteryear_tb ORDER BY semesterYear_id DESC LIMIT 1");
        $count = mysqli_num_rows($sql);
        if($count != 0){
            $row = mysqli_fetch_assoc($sql);
            $isNotEmpty = true;
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    if($isNotEmpty == true){
        $latest_id = $row['semesterYear_id'];
        try {
            mysqli_query($connect, "UPDATE `semesteryear_tb` SET `semister_end`= now() WHERE semesterYear_id = '$latest_id';");
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    try {
        mysqli_query($connect, "INSERT INTO `semesteryear_tb`(`semister`) VALUES ('$sem_year')");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}

?>