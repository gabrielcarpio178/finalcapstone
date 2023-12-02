<?php
require('Dbconnection.php');
if(isset($_POST['info'])){

    $allLabel = array('All', 'BSIS', 'BSCrim', 'BSED', 'BEED', 'BSOA', 'ABE', 'SASO', 'Faculty', 'Guidance', 'Registrar', 'Admin', 'SSG');
    $array = array();
    $user_category = array();
    $all = array();
    $all['All']  = 0;
    for($i = 0; $i < count($allLabel); $i++){
        try {
            $sql = mysqli_query($connect, "SELECT COUNT(student_tb.course) AS total_course, COUNT(personnel_tb.department) AS total_department, student_tb.course, personnel_tb.department, user_tb.usertype FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id WHERE personnel_tb.department='$allLabel[$i]' OR student_tb.course = '$allLabel[$i]' GROUP BY student_tb.course, personnel_tb.department;");
            $row = mysqli_fetch_assoc($sql);
            if(!empty($row)){
                do{
                    if($row['usertype']=='personnel'){
                        $user_category[$allLabel[$i]] = $row['total_department'];
                        $all['All'] = $row['total_department']+ $all['All'];
                    }elseif($row['usertype']=='student'){
                        $user_category[$allLabel[$i]] = $row['total_course'];
                        $all['All'] = $row['total_course'] + $all['All'];
                    }
                }while($row = mysqli_fetch_array($sql));
            }else{
                $user_category[$allLabel[$i]] = 0;
                $all['All'] = 0 + $all['All'];
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    try {
        $total_teller_sql = mysqli_query($connect, "SELECT COUNT(*) AS total_num_teller FROM telleruser_tb;");
    } catch (\Throwable $th) {
        echo $th;
    }
    $teller_num = 0;
    while($total_teller = mysqli_fetch_assoc($total_teller_sql)){
        $teller_num = $total_teller['total_num_teller'];
    }
    $all_num_user = $all['All'] + $teller_num;
    array_push($array, $user_category, $allLabel, $all_num_user, $teller_num);
    print_r(json_encode($array));
}
?>