<?php 
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="cashier")){
   if(!isset($_SERVER['HTTP_REFERER'])){
       header('location: ../../index.php');
    exit;
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/cashierrequest.css">
    <title>Require</title>
</head>
<body>
    <div id="nav"></div>
    <div class="contents">

        <div class="fw-bold label-request">Request</div>
        <div class="">Home</div>

        <div class="content-menu mt-5">
            <div class="d-flex flex-row justify-content-around align-self-center content-header">
                <div id="non_bago" class="focus-1 fucos-class">NON-BAGO FEE</div>
                <div id="cash_out" class="focus-2">CASH OUT</div>
                <div id="certificate" class="focus-3">CERTIFICATE</div>
            </div>

            <div class="table-content">

            </div>
            

        </div>

    </div>
    
</body>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  ></script>
  <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
  <script src="../../js/cashierrequest.js"></script>
</html>