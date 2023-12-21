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
    if($_GET['type']=='purchase'){
        $ref_num = $_GET['ref_num'];
        $user_id = $_SESSION['id'];
        $query = "SELECT telleruser_tb.store_name, order_tb.order_time, SUM(order_tb.order_amount) AS total_amount, order_tb.user_id, order_tb.order_num FROM order_tb INNER JOIN telleruser_tb ON telleruser_tb.teller_id = order_tb.teller_id WHERE order_tb.user_id = '$user_id' AND (order_tb.statues = 'PROCEED' OR order_tb.statues = 'PURCHASE') AND order_tb.order_num='$ref_num' GROUP BY order_tb.order_num";
    }

    try {
        $sql = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    $time = date('h:i A', strtotime($row['order_time']));

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="stylesheet" href="css/pdf.css">
        <link rel="stylesheet" href="css/interfont.css">
    </head>
    <style>
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
        <div class='content'>
            <div>
                <p>Sent to <?=$row['store_name'] ?> </p>
            </div> 
            <table>
                <tr>
                    <td>Date & Time:</td>
                    <td><?=$time ?></td>
                </tr>
                <tr>
                    <td>Amount:</td>
                    <td><?=$row['total_amount'] ?></td>
                </tr>
                <tr>
                    <td>Reference No.:</td>
                    <td><?=$row['order_num'] ?></td>
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
    $dompdf->stream("Receipt", array("Attachment" => 0));
}

?>
