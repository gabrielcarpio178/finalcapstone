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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/cashierhomepage.css" />
    <title>Homepage</title>
  </head>
  <body>
    <div id="nav"></div>
    <div class="contents">
      <div class="fw-bold label-home">Home</div>
      <div class="row mt-5">

        <div class="col-12 col-lg-4 content" id="content_1">
          <p>Student</p>
          <hr>
          <div class="d-flex flex-row justify-content-between view-detail">
            <p>View Details</p>
            <i class="fa-solid fa-angle-right"></i>
          </div>
        </div>

        <div class="col-12 col-lg-4 content" id="content_2">
          <p>Personnel</p>
          <hr>
          <div class="d-flex flex-row justify-content-between view-detail">
            <p>View Details</p>
            <i class="fa-solid fa-angle-right"></i>
          </div>
        </div>

        <div class="col-12 col-lg-4 content" id="content_3">
          <p>Requires</p>
          <hr>
          <div class="d-flex flex-row justify-content-between view-detail">
            <p>View Details</p>
            <i class="fa-solid fa-angle-right"></i>
          </div>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../js/cashierhomepage.js"></script>
</html>
