<?php
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="teller")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
    }
}

$teller_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
<link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
<link rel="stylesheet" href="../../css/all.min.css">
<link rel="stylesheet" href="../../css/sweetalert2.min.css">
<link rel="stylesheet" href="../../css/bootstrap.min.css">   
<link rel="stylesheet" href="../../css/tellerorder.css">
    <title>order</title>
</head>
<body>
    <div id="nav"></div>   
    <div class="container-fluid">

        <div class="d-flex align-items-center flex-row">
            <b class="order-label">ORDER</b> 
        </div>  

        <div class="d-flex flex-row gap-4 mt-5 btn_content">
            <div class="pending-info">
                <div class="pending-count" id="count_pending"></div>
                <button class="btn btn-outline-primary" onclick="getContentData('pending');">Pending</button>
            </div>
            <div class="accepted-info">
                <div class="accepted-count" id="count_accepted"></div>
                <button class="btn btn-outline-primary" onclick="getContentData('accepted');">Accepted</button>
            </div>
        </div>

        <div class="d-flex flex-column gap-2 table-content mt-4 p-3" id="table_content">

            

        </div>


    </div>

    <input type="hidden" data-bs-toggle="modal" data-bs-target="#exampleModal" id="order_info" >
    <input type="hidden" data-bs-toggle="modal" data-bs-target="#procced_modal" id="proceed" >

    <!-- order summary -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Summary</h5>
                <button type="button" class="btn-close" id="close_modal_summary" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="table-order">
                    <div class="order-content">
                        Order
                    </div>
                    <div id="table-content">
                        
                    </div>
                </div>
                
            </div>

            <div class="d-flex flex-row justify-content-center modal-footer">
                <button type="button" class="btn btn-success accent_btn"></button>
                <button type="button" class="btn btn-danger decline">Decline</button>
            </div>

            </div>
        </div>
    </div>


    <!-- input time -->
    <div class="modal fade" id="insert_time" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close_time"></button>
            </div>
            <form id="submitdeadline">
                <div class="modal-body">

                    <input type="hidden" value="" class="order_num" id="order_num">
                    <input type="hidden" value="" id="order_date" class="order_date">
                    <div class="d-flex flex-row align-items-center">
                        <input type="number" class="form-control" id="inputedtime" name="inputedtime" placeholder="Insert Time"
                        />    
                        <div>MINS</div>
                    </div>
                    
                </div>

                <div class="d-flex flex-row justify-content-center modal-footer">
                    <input type="submit" value="submit" data-bs-dismiss="modal" class="btn btn-primary"> 
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
            </div>
        </div>
    </div>


            
</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"></script> -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/tellerorder.js"></script>
<script src="../../js/moment.min.js"></script>
</html>
