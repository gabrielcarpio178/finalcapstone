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
            <h2><b>History</b></h2>
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
        <button type="button" class="btn btn-primary btn-modal" data-bs-toggle="modal" data-bs-target="#modal_data" id="btn_showModal">
            showmodal
        </button>
    </div>
    <!-- Modal -->
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
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../js/cashierhistory.js"></script>
</html>