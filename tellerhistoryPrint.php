<?php
require('controller/Dbconnection.php');
use Dompdf\Dompdf; 
use Dompdf\Options;
require 'dompdf/autoload.inc.php'; 
$option = new Options();
$option->set('chroot', realpath(''));
$dompdf = new Dompdf($option);
ob_start();
if(isset($_GET['order_num'])){
    $order_num = $_GET['order_num'];
    try {
        $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname,order_tb.orderproduct_name, order_tb.order_quantity, SUM(order_tb.order_amount) AS total_amount, order_tb.order_num, order_tb.order_time, user_tb.usertype, student_tb.course, student_tb.studentID_number, personnel_tb.department FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id INNER JOIN order_tb ON user_tb.user_id = order_tb.user_id WHERE order_tb.order_num = '$order_num' GROUP BY order_tb.order_num;");
        
        $array_data = array();
        while($row = mysqli_fetch_assoc($sql)){
            if($row['course']!=null){
                $department = $row['course'];
            }else{
                $department = $row['department'];
            }
            $array_data = array('name'=>$row['firstname']." ".$row['lastname'], 'department'=>$department, 'date'=>$row['order_time'], 'total_amount'=>$row['total_amount'], 'ref_num'=>$row['order_num'], "user_data_id" => $row['studentID_number']);
        }
    } catch (\Throwable $th) {
        echo $th;
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
                <td>Full Name:</td>
                <td><?=$array_data['name'] ?></td>
            </tr>
            <tr>
                <td>Department:</td>
                <td><?=$array_data['department'] ?></td>
            </tr>
            <tr>
                <td>User ID:</td>
                <td><?=$array_data['user_data_id'] ?></td>
            </tr>
            <tr>
                <td>Payment for:</td>
                <td>Purchase</td>
            </tr>
            <tr>
                <td>Date & Time:</td>
                <td><?=getdisplaydate('data',$array_data['date']) ?></td>
            </tr>
            <tr>
                <td>Amount:</td>
                <td><?=$array_data['total_amount'] ?></td>
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
