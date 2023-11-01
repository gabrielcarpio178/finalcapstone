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

        <div class="d-flex flex-column content-label">
            <div class="label-data fw-bold">Account Balance</div>
            <div class="label-info">( Non Bago Fee )</div>
        </div>

        <div class="search-content">
            <input type="text" name="search_user" id="search_user" class="form-control w-25" placeholder="Search Name Or ID">
        </div>

        <div class="d-flex flex-row justify-content-end sort-content gap-2">

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
                First Semester
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../js/cashieraccount_balance.js"></script>
</html>