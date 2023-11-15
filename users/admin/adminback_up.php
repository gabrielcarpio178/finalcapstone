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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css">  
    <link rel="stylesheet" href="../../css/adminback_up.css">
    <title>Back Up</title>
</head>
<body>
    <div id="nav"></div>
    <div class="content-info">
        <div class="d-flex flex-column content-label">
            <h1><b>BACK UP</b></h1>
            <div class="label">Copy or save the system data on a device.</div>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center sign-in">
            <form id="sign_in">
                <div class="d-flex flex-column justify-content-center gap-3 sign-content">
                    <h2 class="text-center">Sign In</h2>
                    <div>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <div class="password-class">
                            <input type="password" name="password" id="password" class="form-control">
                            <i class="fa-solid fa-eye-slash" id="show_password"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
            </form>
            <div class="btn-modal">

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column align-items-center gap-2" id="btn_content">
                </div>
            </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="../../js/adminback_up.js"></script>
</html>