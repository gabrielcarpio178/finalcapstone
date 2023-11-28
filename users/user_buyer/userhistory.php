<?php
session_start();
require('../../controller/Dbconnection.php');
if(!isset($_SESSION['id'])&&($_SESSION['usertype']!="student"||$_SESSION['usertype']!="personnel")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
    }
}
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/userhistory.css"> 
    <title>History</title>
</head>
<body>
    <div id="navbar"></div>
    <div class="content-info w-100">
        <div class="d-flex flex-row justify-content-between label-content">
            <h1>
                <b>HISTORY</b>
            </h1>
            
        </div>

        <div class="d-flex flex-row justify-content-lg-end justify-content-between  align-items-center gap-4 w-100 p-lg-3 p-2">
            <div class="d-flex flex-lg-row flex-column">
                <div class="d-flex flex-lg-row flex-column align-items-start align-items-lg-center gap-lg-2" id="date_div">
                    <label for="date_filter" style="white-space: nowrap;">Sort by Date:</label>
                    <input type="date" class="form-control form-control-sm w-100" id="date_filter">
                </div>
                <div class="d-flex flex-lg-row flex-column align-items-start align-items-lg-center gap-lg-2" id="trans_div">
                    <label for="category_transfers" style="white-space: nowrap;" class="label-category_transfers">Sort by Transfers Funds:</label>
                    <select name="category_transfers" id="category_transfers" class="form-select form-select-sm w-lg-75 w-100 align-self-end" aria-label=".form-select-sm example">
                        <option value="all">All</option>
                        <option value="sent">Sent</option>
                        <option value="receive">Received</option>
                    </select>
                </div>
            </div>
            
            <div class="selected-filter">

            </div>
            <button class="btn btn-outline-primary btn-filter-modal" data-bs-toggle="modal" data-bs-target="#btn_filter"><i class="fa-solid fa-filter"></i>Filter</button>
        </div>

        <div class="history-data" id="history_info">

            <!-- data_info -->

        </div>
        <button type="button" class="btn btn-primary btn-modal" data-bs-toggle="modal" data-bs-target="#modal_data" id="btn_showModal">
            showmodal
        </button>
    </div>
    <!-- modal filter -->
    <div class="modal fade" id="btn_filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Categories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="request_payment" value="Request Payment">
                            <label class="form-check-label" for="request_payment">
                                Request Payment
                            </label>
                        </div>
                        <select name="payment" id="payment" class="form-select form-select-sm w-25" aria-label=".form-select-sm example" disabled='disabled'>

                        </select>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="purchase" value="Purchase">
                        <label class="form-check-label" for="purchase">
                            Purchase
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="cash_in" value="Cash In">
                        <label class="form-check-label" for="cash_in">
                            Cash In
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="transfers_funds" value="Transfers Funds">
                        <label class="form-check-label" for="transfers_funds">
                            Transfers Funds
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal info -->
    <div class="modal fade" id="modal_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Transaction History</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="d-flex flex-column content-modalInfo">
                    <div class="d-flex flex-row" id="payment_for">
                        
                    </div>
                    <div class="d-flex flex-row" id="date_and_time">
                        
                    </div>
                    <div class="d-flex flex-row" id="amount">

                    </div>
                    <div class="d-flex flex-row" id="ref_num">

                    </div>
                </div>

                <center><button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button></center>
            </div>
            
            </div>
        </div>
    </div>

</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"></script> -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script src="../../js/userhistory.js"></script>
</html>