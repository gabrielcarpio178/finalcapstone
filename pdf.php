<?php
require('controller/Dbconnection.php');
session_start();

if(isset($_GET['teller_id'])){
    $teller_id = $_GET['teller_id'];
    try {
        $sql = mysqli_query($connect, "SELECT * FROM telleruser_tb WHERE teller_id = '$teller_id';");
        $row = mysqli_fetch_assoc($sql);
        $teller_storename = ucfirst($row['store_name']);
    } catch (\Throwable $th) {
        echo $th;
    }
}

use Dompdf\Dompdf; 
use Dompdf\Options;
require 'dompdf/autoload.inc.php'; 
$option = new Options();
$option->set('chroot', realpath(''));
$dompdf = new Dompdf($option);
ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/pdf.css">
    <link rel="stylesheet" href="css/interfont.css">
</head>
<body>
    <div class='content'>
        <h2>BCC Digital Payment System</h2>
        <img src="image/icon_1.png" class="logo">
        <div class="title">Scan to Pay</div>
        <img src="users/teller/tellerqrimage/<?=$row['tellerqr_image'] ?>" class="qr">
        <div class="store-name"><b><?=$teller_storename ?></b></div>
        <div class="label">Store Name</div>
    </div>
</body>
</html>

<?php
$html = ob_get_clean();
$dompdf->loadHtml($html); 
$dompdf->setPaper('A4', 'Portrait'); 
$dompdf->set_option('defaultMediaType', 'all');
$dompdf->set_option('isFontSubsettingEnabled', true);
$dompdf->render(); 
$dompdf->stream($teller_storename."_Qrcode", array("Attachment" => 0));
?>