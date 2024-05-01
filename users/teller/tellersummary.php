<?php
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="teller")){
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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/tellersummary.css">
    <title>Shop Performance</title>
</head>
<body>

    <div id="nav"></div>
    
    <div class="content">
    <input type="hidden" name="teller_id" id="teller_id" value="<?=$_SESSION['id']; ?>">
        <div class="label-content pt-5">
            <h2>STORE PERFORMANCE</h2>
            <div>
                <p>Overview</p>
            </div>
        </div>

        <div class="row">

            <div class="col-12 col-lg-8">
                <div class="data-graph">
                    <div class="d-flex flex-column btn-with-graph">
                        <div class="d-flex flex-row justify-content-around button">
                            <button class="btn-infoby 1" id="daily">DAILY</button>
                            <!-- <button class="btn-infoby 2" id="weekly">WEEK</button> -->
                            <button class="btn-infoby 3" id="monthly">MONTHLY</button>
                            <button class="btn-infoby 4" id="yearly">YEARLY</button>
                        </div>
                        <!-- graph -->
                        <canvas id="graph"></canvas>
                    </div>
                    <div class="d-flex flex-row justify-content-around mt-3 order-info">
                        <div class="d-flex flex-column align-items-center data-info_2">
                            <div class="number-data-info num-unpaid"></div>
                            <div class="label-data-info">Unpaid Orders</div>                        
                        </div>
                        <div class="d-flex flex-column align-items-center data-info_2">
                            <div class="number-data-info num-pending">0</div>
                            <div class="label-data-info">Pending</div>
                        </div>
                        <div class="d-flex flex-column align-items-center data-info_2">
                            <div class="number-data-info num-proceed">0</div>
                            <div class="label-data-info">Order Success</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 p-3">
                <div class="data-info">
                    <div class="label-profit bg-warning" id="total_revenue">
                        <div class="d-flex flex-row justify-content-between revenue">
                            <p>Total Revenue</p>
                            <small id="year"></small>
                        </div>
                        <div class="revenue-number text-center fw-bold h2"></div>
                    </div>
                    <div class="label-profit bg-secondary" id="daily_sale">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="daily">Daily Sale</div>
                            <small id="date"></small>
                        </div>
                        
                        <div class="daily-number text-center fw-bold h2"></div>
                    </div>
                    <div class="label-profit bg-primary" id="current_monthly_sale">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="current-month">Monthly Sale</div>
                            <small id="month"></small>
                        </div>                   
                        <div class="current-month-number text-center fw-bold h2"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    
</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
<script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
<script src="../../js/jquery.min.js"></script>
<!-- <script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script> -->
<script src="../../js/tellersummary.js"></script>

</html>