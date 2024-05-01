<?php
require('Dbconnection.php');
if(isset($_POST['ref_num'])){
    $ref_num = $_POST['ref_num'];
    try {
        $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, user_tb.gender,cashin_tb.cashin_amount, cashin_tb.ref_num, cashin_tb.cashin_date FROM cashin_tb INNER JOIN user_tb ON cashin_tb.user_id = user_tb.user_id WHERE cashin_tb.ref_num = '$ref_num';");
        $row = mysqli_fetch_assoc($sql);
        print_r(json_encode($row));
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>