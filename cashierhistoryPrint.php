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
if(isset($_GET['ref_num'])&&isset($_GET['type_payment'])){
    $ref_num = $_GET['ref_num'];
    $type_payment = $_GET['type_payment'];
    if($type_payment=='digitalPayment'){
        $sql = "SELECT CONCAT(u.firstname, ' ', u.lastname) AS name, d.`payment_amount` AS amount, d.`payment_date` AS date_, d.`payment_ref` AS ref_num, d.`payment_type` AS type_payment FROM `digitalpayment_tb` AS d INNER JOIN user_tb AS u ON d.user_id = u.user_id WHERE d.`payment_ref`='$ref_num';";
    }
    elseif($type_payment=='cashout'){
        $sql = "SELECT t.firstname_teller AS name, c.`cashout_refnum` AS ref_num, c.`cashout_amount` AS amount, c.`cashout_date` AS date_, 'Cashout' AS type_payment FROM `cashout_tb` AS c INNER JOIN `telleruser_tb` AS t ON c.teller_id = t.teller_id WHERE c.`cashout_refnum`='$ref_num';";
    }elseif($type_payment=='cashin'){
        $sql = "SELECT CONCAT(u.firstname, ' ', u.lastname) AS name, c.`cashin_amount` AS amount, c.`ref_num` AS ref_num, c.`cashin_date` AS date_, 'Cashin' AS type_payment FROM `cashin_tb` AS c INNER JOIN `user_tb` AS u ON c.user_id = u.user_id WHERE c.`ref_num`='$ref_num';";
    }

    function getdata($sql, $connect){
        $array_data = array();
        try {
            $query = mysqli_query($connect, $sql);
            while($row = mysqli_fetch_assoc($query)){
                $array_data = array('name'=>$row['name'], 'amount'=>$row['amount'], 'ref_num'=>$row['ref_num'], 'type_payment'=>$row['type_payment'], 'date'=>$row['date_']);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        return $array_data;
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
    $result = getdata($sql, $connect);
    
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
                <td>Name: </td>
                <td><?=$result['name'] ?></td>
            </tr>
            <tr>
                <td>Date & Time:</td>
                <td><?=getdisplaydate('data', $result['date']) ?></td>
            </tr>
            <tr>
                <td>Type Payment:</td>
                <td><?=$result['type_payment'] ?></td>
            </tr>
            <tr>
                <td>Amount:</td>
                <td><?=$result['amount'] ?>.00</td>
            </tr>
            <tr>
                <td>Reference No.:</td>
                <td><?=$result['ref_num'] ?></td>
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