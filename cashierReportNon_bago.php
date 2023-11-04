<?php
session_start();
// echo $_SESSION['query'];
use Dompdf\Dompdf; 
use Dompdf\Options;
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