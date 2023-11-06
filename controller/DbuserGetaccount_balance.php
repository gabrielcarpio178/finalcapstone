<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];

    try {
        $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, student_tb.studentID_number, student_tb.course, student_tb.program_description, student_tb.year, user_tb.complete_address FROM user_tb INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id WHERE user_tb.user_id = '$user_id';");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_semister = mysqli_query($connect, "SELECT `semester`, `semester_start`, `semester_end` FROM semesteryear_tb ORDER BY semesterYear_id DESC LIMIT 2");
        while($semister_row = mysqli_fetch_assoc($sql_semister)){
            if($semister_row['semester']=='first-semester'){
                $semister_start = $semister_row['semester_start'];
            }
            if($semister_row['semester_end']==NULL){
                $semister = ucfirst($semister_row['semester']);
            }
        }
    } catch (\Throwable $th) {
        echo $th;
    }


    try {
        $sql_semisterdate = mysqli_query($connect, "SELECT `semester`, `semester_start` FROM semesteryear_tb ORDER BY semesterYear_id DESC LIMIT 1");
        $semister_rowdate = mysqli_fetch_assoc($sql_semisterdate);
        $semister_startdate = $semister_rowdate['semester_start'];
        $semisterdate = $semister_rowdate['semester'];
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $amount_nonBago_sql = mysqli_query($connect, "SELECT cashierRates_amount FROM `cashierrates_tb` WHERE `cashierRates_id` = '1';");
        $amount_row = mysqli_fetch_assoc($amount_nonBago_sql);
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_ispaid = mysqli_query($connect, "SELECT COUNT(`payment_type`) AS isPaid FROM `digitalpayment_tb` WHERE `user_id` = '$user_id' AND `payment_type` = 'Non Bago fee' AND (CAST(payment_date AS DATE) BETWEEN '$semister_startdate' AND CAST(NOW() AS DATE)) AND semester_year = '$semisterdate';");
        $ispaid = mysqli_fetch_assoc($sql_ispaid);
        if($ispaid['isPaid']==1){
            $payment_amount = 0;
        }else{
            $payment_amount = $amount_row['cashierRates_amount'];
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    $user_data = array("firstname"=>$row['firstname'], "lastname"=>$row['lastname'], "studentID_number"=>$row['studentID_number'], "course"=>$row['course'], "program_description"=>$row['program_description'], "year"=>$row['year'], "complete_address"=>$row['complete_address'], "non_bago_payment" => $payment_amount, "amount_payment"=>$amount_row['cashierRates_amount'], "semester"=>$semister, "year"=>date('Y', strtotime($semister_start)));
    print_r(json_encode($user_data));
}
?>