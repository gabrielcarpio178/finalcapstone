<?php
require('Dbconnection.php');
require('../fpdf/fpdf.php');
session_start();
if(($_SESSION['usertype']!="teller"||$_SESSION['usertype']!="admin")){
   if(!isset($_SERVER['HTTP_REFERER'])){
       header('location: ../../index.php');
    exit;
   }
}
if(isset($_GET['teller_id'])){
    $teller_id = $_GET['teller_id'];

    try {
        $sql = mysqli_query($connect, "SELECT * FROM telleruser_tb WHERE teller_id = '$teller_id';");
        $row = mysqli_fetch_assoc($sql);
        $image = "../users/teller/tellerqrimage/".$row['tellerqr_image'];
        $teller_storename = $row['store_name'];
    } catch (\Throwable $th) {
        echo $th;
    }

}

$pdf = new FPDF(); 
$pdf->AddPage();
$pdf->SetFont('Arial','B',50); 
$pdf->Cell(70);
$pdf->Cell(50,35,$teller_storename,5,0,'C');
$pdf->Image($image,15,60,180,180,'PNG');
$pdf->Output();
  
?>