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
    <link rel="stylesheet" href="../../css/cashierhistory.css">
    <title>History</title>
</head>
<body>
    <div id="nav"></div>
    <div class="content-info">
        <div class="header-info">
            <h2><b>HISTORY</b></h2>
        </div>
        <div class="d-flex flex-row justify-content-start gap-5">
            <div class="d-flex flex-column gap-2 departmenr-search">
                <label for="category">
                    Sort By Category:
                </label>
                <select name="category" id="category" class="form-select category">
                    <option value="all">All</option>
                    <option value="cashin">Cash In</option>
                    <option value="cashout">Cash Out</option>
                    <option value="payment">Payment</option>
                </select>
            </div>
            <div class="d-flex flex-column gap-2 date-search">
                <label for="date_name">
                    Date:
                </label>
                <input type="date" name="date_name" id="date_name" class="form-control">
            </div>
        </div>

        <div class="data-info w-100 mt-2">
            
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
<script src="../../js/cashierhistory.js"></script>
</html>