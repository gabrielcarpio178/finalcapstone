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
    <link rel="stylesheet" href="../../css/cashiercollection.css">
    <title>Collection</title>
</head>
<body>
    <div id="nav"></div>
    <div class="containder-fluid">
        <div class="row">
            <div class="col-9">
                <div class="content">
                    <div class="content-label">
                        Collection
                    </div>
                    <div class="content-data">
                        <div class="d-flex flex-row justify-content-between p-3 collection-info">
                            <div class="collection" id="daily">
                                <div class="label-info d-flex flex-row justify-content-between">
                                    <div class="daily-collection">Daily School Fee</div>
                                    <div class="collection-date"></div>
                                </div>
                                <div class="amount-collection" id="school_fee"></div>
                            </div>
                            <div class="collection" id="cash-in">
                                <div class="label-info d-flex flex-row justify-content-between">
                                    <div class="daily-collection">Cash In Collection</div>
                                    <div class="collection-date"></div>
                                </div>
                                <div class="amount-collection" id="cashin"></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row justify-content-between align-items-center p-3 request-collection">
                            <div class="request">Request Collection</div>
                            <div class="d-flex flex-column date-current">
                                <div class="d-flex flex-row date-icon">
                                    <div class="current">Today</div>
                                    <i class="fa-solid fa-triangle fa-rotate-180"></i>
                                </div>
                                <div class="today"></div>
                            </div>
                        </div>

                        <div class="content-category p-3">
                            <div class="data">
                                <div class="color-content" id="content_1"></div>
                                <div class="data-label">
                                    <div class="category">
                                        Non Bago Fee
                                    </div>
                                    <div class="data-amount" id="non_bago"></div>
                                </div>
                            </div>
                            <div class="data">
                                <div class="color-content" id="content_2"></div>
                                <div class="data-label">
                                    <div class="category">
                                        Certificate
                                    </div>
                                    <div class="data-amount" id="cert"></div>
                                </div>
                            </div>
                            <div class="data">
                                <div class="color-content" id="content_3"></div>
                                <div class="data-label">
                                    <div class="category">
                                        Transcript of Records
                                    </div>
                                    <div class="data-amount" id="cert_t"></div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row justify-content-around mt-3 btn-category">
                            <div id="non_bago" class="focus-1 fucos-class">NON-BAGO FEE</div>
                            <div id="tor" class="focus-2">TOR</div>
                            <div id="cash_out" class="focus-3">CASH OUT</div>
                            <div id="cash_in" class="focus-4">CASH IN</div>
                            <div id="certificate" class="focus-5">CERTIFICATE</div>
                        </div>

                        <div class="d-flex flex-row justify-content-between p-3 w-100 latest-transaction">
                            <div class="label-latest-transaction">
                                Latest Transaction
                            </div>
                            <div class="sort-by w-25">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="sortBy">
                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column table-content">
                        
                    </div>

                </div>
            </div>
            <div class="col-3 total-collection">

                <div class="content_2">
                    <div class="d-flex flex-row justify-content-between align-items-center total-collection-label">
                        <div class="d-flex flex-column">
                            <div class="label-collection">
                                Total Collection
                            </div>
                            <div class="d-flex flex-row gap-2 time-two">
                                <div class="current">Today</div>
                                <div class="today"></div>
                            </div>
                        </div>
                    </div>
                    <div class="total-collection-amount">
                        
                    </div>
                    <div class="d-flex flex-row justify-content-around color-info">
                        <div class="color-label-content"> 
                            <div class="color-label" id="collect-color_1"></div>
                            <div class="label-text">Daily School Fee</div>
                        </div>
                        <div class="color-label-content">
                            <div class="color-label" id="collect-color_2"></div>
                            <div class="label-text" >Cash In Collection</div>
                        </div>
                    </div>
                    <hr>

                    <div class="collection-balance-content p-2">
                        <div class="d-flex flex-row justify-content-between align-items-center total-collection-label">
                            <div class="label-collection-balance">
                                Cash In Collection
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-2">

                            <div class="d-flex flex-row align-items-center gap-2 cashIn-collection">
                                <div class="cashIn-collection-color"></div>
                                <div class="d-flex flex-column">
                                    <div class="cashIn-collection-label">
                                        Balance
                                    </div>
                                    <div class="cashIn-collection-amount">
                                        
                                    </div>
                                </div>
                            </div>    

                        </div>
                    </div>
                        
                    <hr>
                    <div class="cashout-data p-3"> 

                        <div class="d-flex flex-column total-collection-label">
                            <div class="cashOut-label fw-bold">
                                Cash Out Balance
                            </div>
                            <div class="d-flex flex-row gap-2 time-two">
                                <div class="current">Today</div>
                                <div class="today"></div>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2 mt-1">
                            <div class="d-flex flex-row align-items-center gap-2 cashOut-collection">
                                <div class="cashOut-collection-color"></div>
                                <div class="d-flex flex-column">
                                    <div class="cashOut-collection-label">
                                        Total Amount
                                    </div>
                                    <div class="cashOut-collection-amount" id="cashOut"></div>
                                </div>
                                
                            </div>
                        </div>
                        
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="../../js/cashiercollection.js"></script>
</html>
