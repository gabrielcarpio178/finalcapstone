<?php
require('Dbconnection.php');
session_start();
if(isset($_POST['name'])&&isset($_POST['department'])&&isset($_POST['date_filter'])&&isset($_POST['statues'])){
    $teller_id = $_SESSION['id'];
    $name = strtoupper($_POST['name']);
    $department = $_POST['department'];
    $date_filter = $_POST['date_filter'];
    $statues = $_POST['statues'];

    if($name=='ALL'&&$department=='all'&&($date_filter=='all'||$date_filter=='')){
        $sql = "SELECT 'order' AS type_content ,order_tb.order_time, CONCAT(user_tb.firstname, ' ', user_tb.lastname) AS name, student_tb.course AS type_statues, order_tb.order_num AS ref_num, personnel_tb.department, SUM(order_tb.order_amount) AS total_amount FROM user_tb INNER JOIN order_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON order_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id WHERE (order_tb.statues = 'PROCEED' OR order_tb.statues = 'PURCHASE') AND order_tb.teller_id = '$teller_id' GROUP BY order_tb.order_num UNION ALL SELECT 'cashout' AS type_content, cashout_tb.`cashout_date` ,telleruser_tb.store_name, cashout_tb.cashout_status, cashout_tb.cashout_refnum, NULL, cashout_tb.`cashout_amount` FROM `cashout_tb` INNER JOIN `telleruser_tb` ON telleruser_tb.teller_id = cashout_tb.teller_id WHERE cashout_tb.teller_id = '$teller_id' ORDER BY ref_num DESC;";
    }
    else if($department!="CASHOUT"){
        if($name=='ALL'||$name==''){
            $name_filter = "";
        }else{
            $name_filter = " AND (user_tb.firstname LIKE '$name%' OR user_tb.lastname LIKE '$name%')";
        }
        if($department=='all'){
            $department_filter = "";
        }else{
            $department_filter = " AND (personnel_tb.department = '$department' OR student_tb.course = '$department')";
        }
        if($date_filter=='all'||$date_filter==''){
            $date_filter_cot = "";
        }else{
            $date_filter_cot =  " AND CAST(order_tb.order_time AS DATE) = '$date_filter'";
        }

        $sql = "SELECT order_tb.order_time, user_tb.firstname, user_tb.lastname, student_tb.course, order_tb.order_num, personnel_tb.department, SUM(order_tb.order_amount) AS total_amount FROM user_tb INNER JOIN order_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON order_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id WHERE (order_tb.statues = 'PROCEED' OR order_tb.statues = 'PURCHASE') AND order_tb.teller_id = '$teller_id'".$department_filter.$name_filter.$date_filter_cot." GROUP BY order_tb.order_num ORDER BY order_tb.order_id DESC";

    }else{

        if($name=='ALL'||$name==''){
            $name_filter = "";
        }else{
            $name_filter = " AND  telleruser_tb.store_name = LIKE '$name%'";
        }

        if($date_filter=='all'||$date_filter==''){
            $date_filter_cot = "";
        }else{
            $date_filter_cot = " AND CAST(cashout_tb.`cashout_date` AS DATE) = '$date_filter'";
        }
        if($statues==''){
            $statues_filter = '';
        }else{
            $statues_filter = " AND cashout_tb.cashout_status = '$statues'";
        }

        $sql = "SELECT 'cashout' AS type_content ,cashout_tb.`cashout_date` AS order_time ,telleruser_tb.store_name AS name, cashout_tb.cashout_status AS type_statues, cashout_tb.cashout_refnum AS ref_num, NULL AS department, cashout_tb.`cashout_amount` AS total_amount FROM `cashout_tb` INNER JOIN `telleruser_tb` ON telleruser_tb.teller_id = cashout_tb.teller_id WHERE cashout_tb.teller_id = '$teller_id'".$name_filter.$date_filter_cot.$statues_filter;
    }

    function getdata($query, $connect){
        $array_table = array();
        try {
            $sql = mysqli_query($connect, $query);
            
            while($row = mysqli_fetch_assoc($sql)){
                if($row['type_statues']==null){
                    $department = $row['department'];
                }else{
                    if($row['type_statues']=='accepted'||$row['type_statues']=='pending'){$department = $row['type_statues'];
                    }else{
                        $department = $row['type_statues'];
                    }
                }
                $array_table[] = array('order_time'=>$row['order_time'], 'name'=>$row['name'], 'department'=>$department, 'order_num'=>$row['ref_num'], 'total_amount'=>$row['total_amount'], 'type_content'=>$row['type_content']);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        return $array_table;
    }
    print_r(json_encode(getdata($sql, $connect)));
}
?>