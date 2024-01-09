<?php
require('controller/Dbconnection.php');
session_start();
use Dompdf\Dompdf; 
use Dompdf\Options;
require 'dompdf/autoload.inc.php'; 
$option = new Options();
$option->set('chroot', realpath(''));
$dompdf = new Dompdf($option);
ob_start();
if(isset($_GET['type'])&&isset($_GET['ref_num'])){
    $array_result = array();
    $ref_num = $_GET['ref_num'];
    $user_id = $_SESSION['id'];
    if($_GET['type']=='purchase'){
        $query = "SELECT telleruser_tb.store_name, order_tb.order_time, SUM(order_tb.order_amount) AS total_amount, order_tb.user_id, order_tb.order_num FROM order_tb INNER JOIN telleruser_tb ON telleruser_tb.teller_id = order_tb.teller_id WHERE order_tb.user_id = '$user_id' AND order_tb.order_num='$ref_num' GROUP BY order_tb.order_num";
        try {
            $sql = mysqli_query($connect, $query);
            $row = mysqli_fetch_assoc($sql);
            $array_result = array('name' => "Send to ".$row['store_name'], 'order_time'=>$row['order_time'], 'amount'=>$row['total_amount'], 'ref_num'=>$row['order_num']);
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($_GET['type']=='receiver'){
        $query = "SELECT u.firstname, u.lastname, s.send_amount, s.sendBalance_ref, s.sendBalance_Date FROM `sendbalance_tb` AS s INNER JOIN `user_tb` AS u ON s.sender_id = u.user_id WHERE s.sendBalance_ref = '$ref_num';";
        try {
            $sql = mysqli_query($connect, $query);
            $row = mysqli_fetch_assoc($sql);
            $array_result = array('name' => "Received Funds ".$row['firstname']." ".$row['lastname'], 'order_time'=>$row['sendBalance_Date'], 'amount'=>$row['send_amount'], 'ref_num'=>$row['sendBalance_ref']);
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($_GET['type']=='sent'){
        $query = "SELECT u.firstname, u.lastname, s.send_amount, s.sendBalance_ref, s.sendBalance_Date FROM `sendbalance_tb` AS s INNER JOIN `user_tb` AS u ON s.receiver_id = u.user_id WHERE s.sendBalance_ref = '$ref_num';";
        try {
            $sql = mysqli_query($connect, $query);
            $row = mysqli_fetch_assoc($sql);
            $array_result = array('name' => "Sent Funds ".$row['firstname']." ".$row['lastname'], 'order_time'=>$row['sendBalance_Date'], 'amount'=>$row['send_amount'], 'ref_num'=>$row['sendBalance_ref']);
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($_GET['type']=='payment'){
        $query = "SELECT u.firstname, u.lastname , d.`payment_type` , d.`payment_amount`, d.`payment_date`, d.`payment_ref` FROM `digitalpayment_tb` AS d INNER JOIN user_tb AS u ON d.`user_id` = u.`user_id` WHERE u.`user_id` = '$user_id' AND d.`payment_ref` = '$ref_num';";
        try {
            $sql = mysqli_query($connect, $query);
            $row = mysqli_fetch_assoc($sql);
            $array_result = array('name' => "Payment for <b>".$row['payment_type']. "</b> <br>Name: ".$row['firstname']." ".$row['lastname'], 'order_time'=>$row['payment_date'], 'amount'=>$row['payment_amount'], 'ref_num'=>$row['payment_ref']);
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($_GET['type']=='cashin'){
        $query = "SELECT u.firstname, u.lastname, cin.cashin_amount, cin.ref_num, cin.cashin_date FROM cashin_tb AS cin INNER JOIN user_tb AS u ON cin.user_id = u.user_id WHERE u.user_id = '$user_id' AND cin.ref_num = '$ref_num'";
        try {
            $sql = mysqli_query($connect, $query);
            $row = mysqli_fetch_assoc($sql);
            $array_result = array('name' => "Cash In ".$row['firstname']." ".$row['lastname'], 'order_time'=>$row['cashin_date'], 'amount'=>$row['cashin_amount'], 'ref_num'=>$row['ref_num']);
        } catch (\Throwable $th) {
            echo $th;
        }
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
            <div>
                <p><?=$array_result['name'] ?> </p>
            </div> 
            <table>
                <tr>
                    <td>Date & Time:</td>
                    <td><?=getdisplaydate('data',$array_result['order_time']) ?></td>
                </tr>
                <tr>
                    <td>Amount:</td>
                    <td><?=$array_result['amount'] ?>.00</td>
                </tr>
                <tr>
                    <td>Reference No.:</td>
                    <td><?=$array_result['ref_num'] ?></td>
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
