<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/cashflow.css">
    <link rel="stylesheet" href="../../css/interfont.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">  
    <title>Cash flow</title>
</head>
<body>
    <div id="nav"></div>
    <div class="content w-75">
        <div class="content-label">
            <h1>Cash Flow</h1>
            <p>Cash Flow Statement of Cashier</p>
        </div>
        <div class="d-flex flex-row w-100 content-data gap-3">
            <div class="table-content">
                <div class="d-flex flex-row justify-content-between table-header-label w-100 history-content">
                    <div class="text-label">TRANSACTION HISTORY</div>
                    <div class="d-flex flex-column">
                        <div class="date-today current_date">
                            
                        </div>
                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa-solid fa-filter"></i>Filter
                        </button>
                    </div>
                </div>
                <div class="info-content w-100" id="info_content">
                    
                    
                </div>
                
            </div>
            <div class="d-flex flex-column collection-info w-100">
                <div class="d-flex flex-row">
                    <div class="daily-cashIn dailycash">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="label-content">DAILY CASH IN</div>
                            <div class="date-label current_date"></div>
                        </div>
                        <div class="amount-label text-center mt-3" id="cashin_daily"></div>
                    </div>
                    <div class="daily-cashOut dailycash">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="label-content">DAILY CASH OUT</div>
                            <div class="date-label current_date"></div>
                        </div>
                        <div class="amount-label text-center mt-3" id="cashout_daily"></div>
                    </div>
                </div>
                <div class="total-cashIn">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="label-content">TOTAL CASH IN COLLECTION</div>
                        <div class="date-label current_date"></div>
                    </div>
                    <div class="amount-label text-center mt-3" id="collection_cashin"></div>
                    <div class="available-label text-center ">Available Balance</div>
                </div>
                <div class="graph-content">
                    <div class="current_date text-end"></div>
                    <canvas id="myChart" class="w-100" style="height: 25vh;"></canvas>
                </div>
            </div>
            <button style="display: none" id="info_btn" data-toggle="modal" data-target="#exampleModalinfo">hidden</button>
            <div id="btn_sign" style="display: none"></div>
        </div>
    </div>

    <!-- Modal filter-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column p-2 gap-4">
                    <div class="d-flex flex-row align-items-center gap-2" style="cursor: pointer;" id="category_content">
                        <i class="fas fa-list fa-xl icon-modal"></i>
                        <div class="d-flex flex-column">
                            <b class="label-modal fs-5">Category</b>
                            <div id="selected_category"></div>
                        </div>
                    </div>
                    <div class="d-flex flex-column p-1 dropdown-list" style="display: none !important;">
                        <ul class="d-flex flex-column gap-2">
                            <li>
                                <div class="all" id="all" onclick="getcategory('All')">All</div>
                            </li>
                            <li>
                                <div class="cashin" id="cashin" onclick="getcategory('Cashin')">Cashin</div>
                            </li>
                            <li>
                                <div class="cashout" id="cashout" onclick="getcategory('Cashout')">Cashout</div>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-row align-items-center gap-2" style="cursor: pointer;" id="date_input">
                        <i class="fas fa-calendar-alt fa-xl icon-modal"></i>
                        <b class="label-modal fs-5">Date</b>
                    </div>
                    <form class="d-flex flex-column p-1 date-list" style="display: none !important;" id="request_form">
                        <input type="text" name="category_type" id="category_type" style="display: none">
                        <div class="label-date-input">
                            <b>Select a Start Date</b>
                            <input type="date" name="start" id="start" class="form-control">
                        </div>
                        <div class="label-date-input">
                            <b>Select a End Date</b>
                            <input type="date" name="end" id="end" class="form-control">
                        </div>
                        <button type="submit" id='btn_sumbit_request' style="display: none">hidden</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_filter">Close</button>
                <button type="button" class="btn btn-primary" id="btn_sumbit">Submit Request</button>
            </div>
            </div>
        </div>
    </div>

    <!-- modal info_data -->
    <div class="modal fade" id="exampleModalinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">History Details</h5>
            </div>
            <div class="modal-body">

                <div class="d-flex flex-column gap-2">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <div class="label-content-data">Payment for <span id="payment_for" class="fw-bold"></span></div>
                        <div id="name"></div>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <div class="label-content-data">
                            Date & Time
                        </div>
                        <div id="datetime"></div>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <div class="label-content-data">
                            Amount
                        </div>
                        <div id="amount_data"></div>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <div class="label-content-data">
                            Reference No.
                        </div>
                        <div id="ref_no"></div>
                    </div>
                </div>

            </div>
            <center>
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </center>
            </div>
        </div>
    </div>
    
    <!-- modal sign_in -->
    <div class="modal fade" id="sign_in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sign in</h5>
            </div>
            <div class="modal-body">
                <form id="sign_form_admin" class="d-flex flex-column gap-3">
                    <p class="text-center">To continue with the require please <b>Sign in</b></p>
                    <label for="user_name">Username</label>
                    <input type="text" class="form-control" id="user_name">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
            </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
<script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/cashflow.js"></script>
</html>