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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/cashieraccount_balance.css">
    <title>Account Balance</title>
</head>
<body>
    <div id="nav"></div>
    <div class="content">

        <div class="d-flex flex-row justify-content-between align-items-center header-label w-100">
            <div class="d-flex flex-column content-label">
                <div class="label-data fw-bold">Account Balance</div>
                <div class="label-info">( Non Bago Fee )</div>
            </div>
            <button class="d-flex flex-row align-items-center justify-content-center  gap-2 btn btn-primary print-btn" data-bs-toggle="modal" data-bs-target="#print_modal">
                <i class="fa-solid fa-print"></i>
                <div class="fw-bold">Print</div>    
            </button>
        </div>

        

        <div class="d-flex flex-row justify-content-end sort-content gap-2">

            <div class="sort-data w-100">
                <label for="search_user">Search Name Or ID:</lebel>
                <div class="search-content">
                    <input type="text" name="search_user" id="search_user" class="form-control form-select-sm w-75" placeholder="Search">
                </div>
            </div>
            
            <div class="sort-data w-100">
                <label for="sortByYear">Sort By Year:</label>
                <select name="sortByYear" id="sortByYear" class="form-select form-select-sm w-50">

                </select>
            </div>
            

            <div class="sort-data w-100">
                <label for="sortBySemister">
                    Sort By Semester:
                </label>
                <select name="sortBySemister" id="sortBySemister" class="form-select form-select-sm w-50">
                </select>
            </div>
            

            <div class="sort-data w-100">
                <label for="sortBy">Sort By Statues:</label>
                <select name="sortBy" id="sortBy" class="form-select form-select-sm w-50">
                    <option value="all">All</option>
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                </select>
            </div>
            

        </div>

        <div class="d-flex flex-row semister-year-label">
            <div class="semister-year">
                
            </div>
        </div>
        
        <div class="table-content">
            
        </div>

        
    </div>

    <!-- modal_print -->
    <div class="modal fade" id="print_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Print</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-row justify-content-between">
                    <button class="btn btn-primary" id="print_report_nonBago">Non-Bago Fee</button>
                    <button class="btn btn-primary">TOR</button>
                    <button class="btn btn-primary">Certifacate</button>
                </div>
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
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"
></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="../../js/cashieraccount_balance.js"></script>
</html>