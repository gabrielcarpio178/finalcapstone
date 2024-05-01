<?php
require('Dbconnection.php');
if(isset($_POST['cashier'])){
    try {
        $sql = mysqli_query($connect, "SELECT `semesterYear_id`, `semester_start`, `semester_end`, `semester_pair` FROM `semesteryear_tb` GROUP BY `semester_pair` ORDER BY `semesterYear_id` DESC;");
        while($row = mysqli_fetch_assoc($sql)){
            $yearsem[] = array("start_year"=>$row['semester_start'], "end_year"=>$row['semester_end'], "semester_pair"=>$row['semester_pair']);
        }
        print_r(json_encode($yearsem));
    } catch (\Throwable $th) {
        echo $th;
    }
} 
?>