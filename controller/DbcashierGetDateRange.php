<?php
require('Dbconnection.php');
date_default_timezone_set('Asia/Manila');
$current_date = date('Y-m-d');
if(isset($_POST['year_pair'])&&isset($_POST['sem_category'])){
    $year_pair = $_POST['year_pair'];
    $sem_category = $_POST['sem_category'];

    if($sem_category=='all'){
        $category_cot = "";
    }else{
        $category_cot = " AND `semester`='".$sem_category."'";
    }

    if($year_pair=='current_year'){
        if($sem_category=='all'){
            $category_cot = " ";
        }else{
            $category_cot = " WHERE `semester`='".$sem_category."'";
        }
        $year_cot = $category_cot.' ORDER BY semesterYear_id DESC LIMIT 1';
    }else {
        $year_cot = " WHERE `semester_pair`='".$year_pair."'".$category_cot."";
    }

    $query = "SELECT `semester_start`, `semester_end` FROM `semesteryear_tb`".$year_cot;

    try {
        $sql = mysqli_query($connect, $query);
        $array_year = array();
        $year_data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $year_data = array($row['semester_start'], $row['semester_end']);
            $array_year = array_merge($array_year, $year_data);
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    $count_year = count($array_year);
    if($count_year!=0){
        if($array_year[1]!=''){
            $date_range = array("start"=>$array_year[0], "end"=>$array_year[$count_year-1]);
        }else{
            $date_range = array("start"=>$array_year[0], "end"=>$current_date);
        }
    }
    print_r(json_encode($date_range));
    
    
}
?>