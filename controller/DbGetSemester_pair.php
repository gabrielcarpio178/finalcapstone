<?php
require('Dbconnection.php');
if(isset($_POST['semester_pair'])){
    $semester_pair = $_POST['semester_pair'];
    if($semester_pair=='current_year'){
        try {
            $sql_getLastPair = mysqli_query($connect, "SELECT semester_pair FROM `semesteryear_tb` GROUP BY `semester_pair` ORDER BY `semesterYear_id` DESC;");
            $get_pair = mysqli_fetch_assoc($sql_getLastPair);
        } catch (\Throwable $th) {
            echo $th;
        }
        $semester_pair = $get_pair['semester_pair'];
    }
    try {
        $sql = mysqli_query($connect, "SELECT `semester` FROM `semesteryear_tb` WHERE `semester_pair` = '$semester_pair';");
        while($row = mysqli_fetch_assoc($sql)){
            $semester_array[] = array("semester"=>$row['semester']);
        }
        print_r(json_encode($semester_array));
    } catch (\Throwable $th) {
        echo $th;
    }
} 

?>