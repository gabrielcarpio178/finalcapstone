<?php
session_start();
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, 
user-scalable=no">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
<link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
<link rel="stylesheet" href="../../css/all.min.css">
<link rel="stylesheet" href="../../css/sweetalert2.min.css">
<link rel="stylesheet" href="../../css/usernav.css">
<link rel="stylesheet" href="../../css/interfont.css">
</head>
<body>  
    <input type="hidden" value="<?=$id ?>" id="user_id">
    <div class="loader"><img src="../../image/loader.gif"></div>  
    <div id="sidebar">
        
        <div class="logo">
            BCC Digital Payment System         
        </div>
        <ul class = "list-inline">
            <!-- <li id="icon_menu" ><a href="#" id="menu"><i class="fas fa-bars" id="burger"></i><span></span></a></li> -->

            <li id="home" class="select_1"><a href="#"><i class="fas fa-home"></i><span>Home</span></a></li>                                

            <li id="history"  class="select_2"><a href="#"><i class="fa-solid fa-clock-rotate-left"></i><span>History</span></a></li> 

            <li id="setting"  class ="select_3"><a href="#" data-bs-toggle="modal" data-bs-target="#procced_modal"><i class="fa-solid fa-gear"></i><span>Setting</span></a></li>         

            <li id="logout" class ="select_4"><a href="#"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a></li>                  
        </ul>
        
    </div> 
    
    <!-- modal -->
    <div class="modal fade" id="procced_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Setting</h5>
                <button type="button" class="btn-close" id="close_modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="d-flex flex-column p-3 gap-3">
                    
                    <div class="d-flex flex-row gap-2 btn_content" onclick="deactivate_data('<?=$id ?>', 'Deactivate', true)">
                        <i class="fa-solid fa-trash"></i>
                        <div class="text-center">Deactivate Account</div>
                    </div>
                    <!-- <div class="d-flex flex-row gap-2 btn_content" id="change_password">
                        <i class="fa-solid fa-lock"></i>
                        <div class="text-center">Change Password</div>
                    </div> -->

                </div>
                
            </div>

            </div>
        </div>
    </div>

</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script src="../../js/usernav.js"></script>

</html>
