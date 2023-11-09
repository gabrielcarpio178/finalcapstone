<?php
session_start();
use Dompdf\Dompdf; 
use Dompdf\Options;
require('controller/Dbconnection.php');
require 'dompdf/autoload.inc.php'; 
$option = new Options();
$option->set('chroot', realpath(''));
$dompdf = new Dompdf($option);
ob_start();
$query = $_SESSION['query'];
$semester = $_SESSION['semester'];
$current_date = $_SESSION['currentDate'];
$isPaid = $_SESSION['isPaid'];
$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cashierReportNon_bago.css">
    <title>Non Bago Payment</title>
</head>
<body>
    <div class="content">
        <div class="header-content">
            <div class="header-label">
                <h3>BCC Digital Payment System</h3>
                <div class="current-date"><?=$current_date ?></div>
            </div>
            <img src="image/bcc_logo.png" class="bcc-logo">
            <div class="report-label">
                Account Balance
            </div>
            <p class="report-info">
                (Non Bago Fee List Report)
            </p>
            <p class="year-label">
                A.Y. <?=date('Y', strtotime($start_date)).'-'.(date('Y', strtotime($start_date)))+1; ?>, <?=$semester ?>
            </p>
            <p class="date-range">
                Date: <?=$start_date." to ".$end_date ?>
            </p>
        </div>
        <div class="table-info">
            <table id="table_result">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Reference #</th>
                        <th>Date Paid</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        try {
                            $sql = mysqli_query($connect, $query);
                        } catch (\Throwable $th) {
                            echo $th;
                        }
                            $sumNon_bagoFee_paid = 0;
                            $total_paid = 0;
                            $total_unpiad = 0;
                            while($row = mysqli_fetch_assoc($sql)){
                                if($row['requestType']=='accepted'){
                                    $sumNon_bagoFee_paid+=$row['payment_amount'];
                                    $total_paid++;
                                }elseif($row['requestType']==NULL||$row['requestType']=="pending"){
                                    $total_unpiad++;
                                }
                        ?>
                        <tr>
                            <td><?=($row['requestType']==NULL||$row['requestType']=="pending")?strtoupper("Unpaid"):strtoupper("Paid") ?></td>
                            <td><?=$row['studentID_number'] ?></td>
                            <td><?=strtoupper($row['firstname'])." ".strtoupper($row['lastname']) ?></td>
                            <td><?=strtoupper($row['course']) ?></td>
                            <td><?=($row['payment_ref']==NULL)?"-- -- --": $row['payment_ref']?></td>
                            <td><?=($row['paid_date']==NULL)?"-- -- --":  $row['paid_date']?></td>
                        </tr>
                        <?php 
                        }
                    ?>
                </tbody>
            </table>
            <div>
                <div class="total-info">
                    <div class="nonBagoFee_sum">
                        Number of Paid: <?=$total_paid ?>
                    </div>
                    <div class="nonBagoFee_sum">
                        Number of Unpaid: <?=$total_unpiad ?>
                    </div>
                    <div class="nonBagoFee_sum">
                        
Total Collection for Non Bago Fee: <span style="font-family: DejaVu Sans;">&#8369;</span> <?=$sumNon_bagoFee_paid ?>
                    </div>
                </div>
            </div>
        </div>
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
$dompdf->stream("Non Bago Payment", array("Attachment" => 0));
?>