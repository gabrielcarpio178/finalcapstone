<?php
require('controller/Dbconnection.php');
use Dompdf\Dompdf; 
use Dompdf\Options;
require 'dompdf/autoload.inc.php'; 
$option = new Options();
$option->set('chroot', realpath(''));
$dompdf = new Dompdf($option);
ob_start();
if(isset($_GET['order_num'])&&isset($_GET['type_content'])){
    $order_num = $_GET['order_num'];
    $type_content = $_GET['type_content'];
    if($type_content!='cashout'){
        $sql = "SELECT CONCAT(user_tb.firstname, ' ', user_tb.lastname) AS name, SUM(order_tb.order_amount) AS total_amount, order_tb.order_num, order_tb.order_time, user_tb.usertype, student_tb.course, student_tb.studentID_number, personnel_tb.department, '' AS payment_statues FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id INNER JOIN order_tb ON user_tb.user_id = order_tb.user_id WHERE order_tb.order_num = '$order_num' GROUP BY order_tb.order_num;";
    }else{
        $sql = "SELECT telleruser_tb.store_name AS name, cashout_tb.`cashout_amount` AS total_amount,  cashout_tb.cashout_refnum AS order_num, cashout_tb.`cashout_date` AS order_time, 'Cashout' AS usertype, '' AS course,'' AS studentID_number, '' AS department, cashout_tb.cashout_status AS payment_statues FROM `cashout_tb` INNER JOIN `telleruser_tb` ON telleruser_tb.teller_id = cashout_tb.teller_id WHERE cashout_tb.cashout_refnum = '$order_num';";
    }
    
    function getdisplaydate($type ,$date){
        $datetime = strtotime($date);
        $month = date('m',$datetime);
        if($month<10){
            if($month=='01'){
                $month = 1;
            }elseif($month=='02'){
                $month = 2;
            }elseif($month=='03'){
                $month = 3;
            }elseif($month=='04'){
                $month = 4;
            }elseif($month=='05'){
                $month = 5;
            }elseif($month=='06'){
                $month = 6;
            }elseif($month=='07'){
                $month = 7;
            }elseif($month=='08'){
                $month = 8;
            }elseif($month=='09'){
                $month = 9;
            }
        }
        $month = $month-1;
        $year = date('Y',$datetime);
        $day = date('d',$datetime);
        $hours = date('h',$datetime);
        $min = date('i',$datetime);
        $time = date('A',$datetime);
        $monthFull = array(
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "June",
            "July",
            "Aug",
            "Sept",
            "Oct",
            "Nov",
            "Dec",
        );
        if($type =='data'){
            $cotdatetime = $monthFull[$month]."-".$day."-".$year." ".$hours.":".$min." ".$time;
        }elseif($type == 'current'){
            $cotdatetime = $monthFull[$month]."-".$day."-".$year;
        }
        return $cotdatetime;
    }

    function getdata($query, $connect){
        $array_data = array();
        try {
            $sql = mysqli_query($connect, $query);
            while($row = mysqli_fetch_assoc($sql)){
                if($row['course']!=null){
                    $department = $row['course'];
                }else{
                    $department = $row['department'];
                }
                $array_data = array('name'=>$row['name'], 'department'=>$department, 'date'=>$row['order_time'], 'total_amount'=>$row['total_amount'], 'ref_num'=>$row['order_num'], "user_data_id" => $row['studentID_number'], 'usertype'=>$row['usertype'], 'payment_statues'=>$row['payment_statues']);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        return $array_data;
    }
    $array_data = getdata($sql, $connect);
    if($array_data['usertype']!='Cashout'){
        $label_name = 'Full Name';
        $department = "
        <tr>
            <td>Department:</td>
            <td>".$array_data['department'] ."</td>
        </tr>
        <tr>
            <td>User ID:</td>
            <td>".$array_data['user_data_id']."</td>
        </tr>
        ";
        $payment_type = "Purchase";
    }else{
        $label_name = 'Store Name';
        $department = "
        <tr>
            <td>Payment Status:</td>
            <td>".$array_data['payment_statues']."</td>
        </tr>
        ";
        $payment_type = "Cashout";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/pdf.css">
    <link rel="stylesheet" href="css/interfont.css">
    <title>History Print</title>
</head>
<style>
            *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body{
        padding: 5%;
        font-family: 'Trebuchet MS', sans-serif;
    }
    .header-content{
        display: flex;
        flex-direction: column;
        text-align: center;
    }
    h3, .current-date{
        display: inline-block; 
    }
    h3{
        margin-right: -100px;
    }
    .current-date{
        float: right;
    }
    .bcc-logo{
        max-width: 15%;
    }
    .report-label{
        font-weight: 700;
    }
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }
    </style>
<body>
    <div class="header-content">
        <div class="header-label">
            <h3>BCC Digital Payment System</h3>
            <div class="current-date"><?=getdisplaydate('current',date("Y-m-d h:i A")) ?></div>
        </div>
        <img src="image/bcc_logo.png" class="bcc-logo">
        <div class="report-label">
            History Print
        </div>
    </div>
    <div class='content'>
        <table>
            <tr>
                <td><?= $label_name ?>:</td>
                <td><?=$array_data['name'] ?></td>
            </tr>
            <?= $department  ?>
            <tr>
                <td>Payment for:</td>
                <td><?=$payment_type ?></td>
            </tr>
            <tr>
                <td>Date & Time:</td>
                <td><?=getdisplaydate('data',$array_data['date']) ?></td>
            </tr>
            <tr>
                <td>Amount:</td>
                <td><?=$array_data['total_amount'] ?>.00</td>
            </tr>
            <tr>
                <td>Reference no. :</td>
                <td><?=$array_data['ref_num'] ?></td>
            </tr>
        </table>
    </div>
</body>
</html>

<?php 
    $html = ob_get_clean();
    $dompdf->loadHtml($html); 
    $dompdf->setPaper('letter', 'Portrait'); 
    $dompdf->set_option('defaultMediaType', 'all');
    $dompdf->set_option('isFontSubsettingEnabled', true);
    $dompdf->render(); 
    $dompdf->stream("History_Print", array("Attachment" => 0));
}

?>
