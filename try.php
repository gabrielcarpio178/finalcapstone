<?php
require('controller/Dbconnection.php');
require_once "phpqrcode/qrlib.php";

function checkqr_num($connect, $qrnum){
        $getqrnum = mysqli_query($connect, "SELECT teller_qr FROM telleruser_tb;");
        while($row = mysqli_fetch_assoc($getqrnum)){
            if($row['teller_qr']==$qrnum){
                $uni = true;
                break;
            }else{
                $uni = false;
            }
        }
        return $uni;
    }

    function generate_key($connect){
        $keylength = 8;
        $str = "1234567890";
        $randomkey = substr(str_shuffle($str), 0, $keylength);
        
        $checkkey = checkqr_num($connect, $randomkey);

        while($checkkey == true){
            $randomkey = substr(str_shuffle($str), 0, $keylength);
            $checkkey = checkqr_num($connect, $randomkey);
        }

        return $randomkey;
    }

    $path = "users";
    $qrkey = generate_key($connect);
    $qr = $path.$qrkey.".png";
    $qrnamimage = $qrkey.".png";
    QRcode :: png($qrkey, $qr, 'H', 4, 4);


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
        <img src="<?=$qr ?>" class="qr">
        <div class="store-name">Unknown QR</div>
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
    $dompdf->stream("Unknown_Qrcode", array("Attachment" => 0));
?>