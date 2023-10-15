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
            <div class="col-8">
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
                                        Cert. of Transfer Creditials
                                    </div>
                                    <div class="data-amount" id="cert_t"></div>
                                </div>
                            </div>
                            <div class="data"> 
                                <div class="color-content" id="content_4"></div>
                                <div class="data-label">
                                    <div class="category">
                                        Cash Out
                                    </div>
                                    <div class="data-amount" id="cashOut"></div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row justify-content-around btn-category">
                            <div id="non_bago" class="focus-1 fucos-class">NON-BAGO FEE</div>
                            <div id="cash_out" class="focus-2">CASH OUT</div>
                            <div id="certificate" class="focus-3">CERTIFICATE</div>
                        </div>

                        <div class="d-flex flex-row justify-content-between p-3 w-100 latest-transaction">
                            <div class="label-latest-transaction">
                                Latest Transaction
                            </div>
                            <div class="sort-by w-25">
                                <select class="form-select form-select-sm " aria-label=".form-select-sm example" id="sortBy" disabled="disabled">
                                    <option selected disabled>Sort By</option>
                                    <option value="Certificate of Enrollment">Certificate of Enrollment</option>
                                    <option value="Certificate  of Transfers">Cert. of Transfer Creditials</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-content">
                        <table class="table table-hover">
                            <thead id="table_head">
                                <!-- <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Amount</th>
                                </tr> -->
                            </thead>
                            <tbody id="table_body">
                                <!-- table row -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4 total-collection">

                <div class="content_2">
                    <div class="d-flex flex-row justify-content-between align-items-center total-collection-label">
                        <div class="label-collection">
                            Total Collection
                        </div>
                    </div>
                    <div class="total-collection-amount">
                        
                    </div>
                    <div class="d-flex flex-row justify-content-around color-info">
                        <div class="color-label-content"> 
                            <div class="color-label" id="collect-color_1"></div>
                            <div class="label-text">Daily Collection</div>
                        </div>
                        <div class="color-label-content">
                            <div class="color-label" id="collect-color_2"></div>
                            <div class="label-text" >Cash In Collection</div>
                        </div>
                    </div>
                    <hr>
                    <div class="graph">
                        <canvas id="graph_data"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
<script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="../../js/cashiercollection.js"></script>
</html>