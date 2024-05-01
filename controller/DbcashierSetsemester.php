<?php
require('Dbconnection.php');
if(isset($_POST['sem_year'])){
    $sem_year = $_POST['sem_year'];
    $isNotEmpty = false;
    try {
        $sql = mysqli_query($connect, "SELECT semesterYear_id, semester, semester_pair FROM semesteryear_tb ORDER BY semesterYear_id DESC LIMIT 1");
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
            mysqli_query($connect, "UPDATE `semesteryear_tb` SET `semester_end`= now() WHERE semesterYear_id = '$latest_id';");
            $semester = $row['semester'];
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    $i = $row['semester_pair'];
    if($row['semester']=='second-semester'){
        $i++;
    }

    try {
        mysqli_query($connect, "INSERT INTO `semesteryear_tb`(`semester`, `semester_pair`) VALUES ('$sem_year', '$i')");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}

?>