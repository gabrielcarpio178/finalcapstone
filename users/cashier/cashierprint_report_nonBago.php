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
    <link rel="stylesheet" href="../../css/cashierprint_report_nonBago.css">
    <title>Print Report</title>
</head>
<body>
    <div id="nav"></div>
    <div class="content">
        <div class="d-flex flex-column align-items-center content-info p-1 gap-1">
            <div class="label-content header-info">
                Bago City Digital Payment System
            </div>
            <img src="../../image/bcc_logo.png" alt="Bcc logo" class="bcc-logo">
            <div class="account-balance">
                Account Balance
            </div>
            <div class="content-category">
                (Non Bago Fee List Report)
            </div>
            <div class="school-year">
                <!-- A.Y. 2023-2024, First Semester -->
            </div>
        </div>
        <div class="d-flex flex-row align-items-between justify-content-center mt-3 filter-data">
            <div class="sort-data">
                <label for="sortByYear">Sort By Year:</label>
                <select name="sortByYear" id="sortByYear" class="form-select form-select-sm w-50">

                </select>
            </div>
            

            <div class="sort-data">
                <label for="sortBySemister">
                    Sort By Semester:
                </label>
                <select name="sortBySemister" id="sortBySemister" class="form-select form-select-sm w-50">
                </select>
            </div>

            <div class="sort-data">
                <label for="start_date">
                    Start Date:
                </label>
                <input type="date" name="" id="start_date" class="form-control form-control-sm">
            </div>
            
            <div class="sort-data">
                <label for="end_date">
                    End Date:
                </label>
                <input type="date" name="" id="end_date" class="form-control form-control-sm">
            </div>

            <div class="sort-data">
                <label for="sortBy">Sort By Statues:</label>
                <select name="sortBy" id="sortBy" class="form-select form-select-sm w-50">
                    <option value="all">All</option>
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                </select>
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
<script src="../../js/cashierprint_report_nonBago.js"></script>
</html>