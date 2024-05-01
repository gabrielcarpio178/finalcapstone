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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    /> -->
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/interfont.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/cashierhomepage.css" />
    <title>Homepage</title>
  </head>
  <body>
    <div id="nav"></div>
    <div class="contents">

      <div class="label-home">Home</div>

      <div class="content-information">
        <div class="d-flex flex-row justify-content-between post-message">
          <div class="d-flex flex-column justify-content-end post">
            <div class="message">
              <h1 class="welcome"></h1> 
            </div>
            <div class="title">
              BCC Digital Payment System
            </div>
          </div>
          <img src="../../image/icon_1.png" >
        </div> 

        <div class="d-flex flex-row content-availabled">
          
          <div class="d-flex flex-row justify-content-around align-items-center click-info" id="request">
            <div class="request-count">
              
            </div>
            <img src="../../image/cashier_request.png" class="logo-info">
            <div class="label-info">Request</div>
          </div>
          <div class="d-flex flex-row justify-content-around align-items-center click-info" id="cashin">
            <img src="../../image/cashier_cashin.png" class="logo-info">
            <div class="label-info">Cash In</div>
          </div>
          <div class="d-flex flex-row justify-content-around align-items-center click-info" id="account-balance">
            <img src="../../image/cashier_accountbalance.png" class="logo-info">
            <div class="label-info">Account<br>Balance</div>
          </div>
          <div class="d-flex flex-row justify-content-around align-items-center click-info" id="collection-div">
            <img src="../../image/cashier_collection.png" class="logo-info">
            <div class="label-info">Collection</div>
          </div>
        </div>

        <div class="d-flex flex-row justify-content-around data-set">

          <div class="collection-amount">
              <div class="collection-date">
              </div>
              <div class="label-collection">
                TOTAL COLLECTION
                <div class="amount-collect" id="amount_collection">
                
                </div>
              </div> 
          </div>

          <div class="graph p-2">
            <canvas id="bar"></canvas>
          </div>

        </div>

      </div>

    </div>
  </body>
  <!-- <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  ></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
  <script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
  <script src="../../js/jquery.min.js"></script>
  <script src="../../js/sweetalert2.all.min.js"></script>
  <script src="../../js/cashierhomepage.js"></script>
  <!-- <script src=".../node_modules/chartjs/to/dist/chart.umd.min.js"></script> -->
  <!-- <script src=".../node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.js"></script> -->
</html>
