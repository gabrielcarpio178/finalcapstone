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
            <button class="d-flex flex-row align-items-center justify-content-center btn btn-primary print-btn" id="print_report_nonBago">
                <i class="fa-solid fa-print"></i>
                <div class="fw-bold">Print</div>    
            </button>
        </div>

        <div class="d-flex flex-row align-items-between content-filter w-100">

            <div class="sort-data w-50">
                <label for="search_user">Search:</lebel>
                <div class="search-content">
                    <input type="text" name="search_user" id="search_user" class="form-control form-select-sm w-100" placeholder="Search  Name Or ID">
                </div>
            </div>

            <div class="d-flex flex-row justify-content-end sort-content gap-2 w-50">

                <div class="sort-data w-100">
                    <label for="sortByYear">Sort By Year:</label>
                    <select name="sortByYear" id="sortByYear" class="form-select form-select-sm w-100">

                    </select>
                </div>
                

                <div class="sort-data w-100">
                    <label for="sortBySemister">
                        Sort By Semester:
                    </label>
                    <select name="sortBySemister" id="sortBySemister" class="form-select form-select-sm w-100">
                    </select>
                </div>
                

                <div class="sort-data w-100">
                    <label for="sortBy">Sort By Status:</label>
                    <select name="sortBy" id="sortBy" class="form-select form-select-sm w-100">
                        <option value="all">All</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                </div>
                

            </div>
        </div>

        <div class="d-flex flex-row semister-year-label">
            <div class="semister-year">
                
            </div>
        </div>
        
        <div class="table-content">
            
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
<script src="../../js/cashieraccount_balance.js"></script>
</html>