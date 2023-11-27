<?php
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="teller")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
    }
}
$name = $_SESSION['teller_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">   
    <link rel="stylesheet" href="../../css/tellerhistory.css">
    <title><?=$name; ?></title>
</head>
<body>
    <div id="nav"></div> 
    <div class="container-fluid">

        <div class="d-flex flex-column content-info">
            <div class="transaction-history fw-bold">HISTORY</div>

            <div class="d-flex flex-row justify-content-between align-items-center">

                <div class="d-flex flex-column w-25">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="d-flex flex-column sort_by">
                    <label for="departmenr">Sort by Department</label>
                    <select name="department" id="department" class="form-control department">
                        <option  selected value='all'>ALL</option>
                        <option value="SASO">SASO</option>
                        <option value="Faculty">FACULTY</option>
                        <option value="Guidance">GUIDANCE</option>
                        <option value="Registerar">REGISTRAR</option>
                        <option value="Admin">ADMIN</option>
                        <option value="SSG">SSG</option>
                        <option value="BSCrim">BSCRIM</option>
                        <option value="BSED">BSED</option>
                        <option value="BEED">BEED</option>
                        <option value="BSOA">BSOA</option>
                        <option value="BSIS">BSIS</option>
                    </select>
                </div>

                <div class="d-flex flex-column w-25">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                
                
            </div>

            
            <div class="d-flex flex-column gap-2 table-info mt-4">
                <!-- show data -->
            </div>
            

        </div>

    </div>
    <button type="button" class="btn btn-primary btn-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btn_showModal" style="display: none">hidden</button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">History Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-row justify-content-between">
                    <label for="name">Full Name: </label>
                    <p class="name" id="name"></p>
                </div>

                <div class="d-flex flex-row justify-content-between">
                    <label for="department_info">Department: </label>
                    <p id="department_info" class="department_info"></p>
                </div>
                
                <div class="d-flex flex-row justify-content-between student_class">
                    <label for="student_id">User ID: </label>
                    <p id="student_id" class="student_id"></p>
                </div>

                <div class="d-flex flex-row justify-content-between">
                    <label for="payment_for">Payment for: </label>
                    <p id="payment_for">Purchase</p>  
                </div>

                <div class="d-flex flex-row justify-content-between">
                    <label for="date_time">Date & Time: </label>
                    <p id="date_time" class="date_time" ></p>
                </div>
                <div class="d-flex flex-row justify-content-between">
                    <label for="amount">Amount: </label>
                    <p id="amount" class="amount"></p>
                </div>
                
                <div class="d-flex flex-row justify-content-between">
                    <label for="reference_num">Reference no. : </label>
                    <p id="reference_num" class="reference_num"></p>
                </div>
                
                <center>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </center>
            </div>

            </div>
        </div>
    </div>
    
    

</body>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/tellerhistory.js"></script>
</html>