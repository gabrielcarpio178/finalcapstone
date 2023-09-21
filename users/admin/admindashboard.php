<?php
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="admin")){
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/admindashboard.css">
    <link rel="stylesheet" href="../../css/interfont.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">  
    <title>Dashboard</title>
</head>
<body>
    <div id="nav"></div>
    <div class="container-fluid">

        <div class="row content w-70">
            <div class="col-12">

                <div class="d-flex flex-column align-self-start label">
                    
                    <h2><b>Dashboard</b></h2>
                    <p>Overview</p>

                </div>

            </div>
            <div class="col-12">

               <div class="information w-100">

                <div class="info bg-success">
                    <div class="date">
                        
                    </div>
                    <div class="number" id="new_user">
                        
                    </div>
                    <div class="label">
                        New Users
                    </div>
                </div>
                <div class="info bg-primary">
                    <div class="date">

                    </div>
                    <div class="number" id="active_user">
                        
                    </div>
                    <div class="label">
                        Active Users
                    </div>
                </div>
                <div class="info bg-warning">
                    <div class="year">
                        Jan 01 - Dec 31 <span id="year"></span>
                    </div>
                    <div class="number" id="total_user">
                        
                    </div>
                    <div class="label">
                        Total Users
                    </div>
                </div>
                
               </div>

            </div>

            <div class="graph mt-3">

            <div class="graph-info">
                <canvas id="bar"></canvas>
            </div>
            <div class="graph-info">
                <canvas id="doughnut"></canvas>
            </div>
                
            </div>

        </div>

    </div>


    

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
<script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="../../js/admindashboard.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
</html>