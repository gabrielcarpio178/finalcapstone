<?php
session_start();
require('../../controller/Dbconnection.php');
if(!isset($_SESSION['id'])){
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, 
user-scalable=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/usertype.css">
    <title>Usertype</title>
</head>
<body>    
    <div class="container p-1 p-lg-5">
        
        <nav>
            <h1 class="fw-bold">SELECT USER TYPE</h1>            
        </nav>
        
        <div class="contents">
            
            <div class="row gy-5 gx-5 m-1 m-lg-5 w-75">
                
                <div class="col-12 col-lg-6">
                   
                   <div class="d-flex flex-column justify-content-center text-center student">
                       <img src="../../image/student.png" alt="Student">
                       <div class="label">
                            Student
                       </div>
                   </div>          
                    
                </div>
                
                <div class="col-12 col-lg-6">
                   
                   <div class="d-flex flex-column justify-content-center text-center personnel">
                       <img src="../../image/personnel.png" alt="Personnel">
                       <div class="label">
                            Personnel
                       </div>
                   </div>          
                    
                </div>
                
            </div>
            
        </div>
                                        
    </div><!-- end container -->
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../../js/usertype.js"></script>
</html>
