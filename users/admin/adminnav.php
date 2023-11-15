
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, 
user-scalable=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../../css/adminnav.css">
<link rel="stylesheet" href="../../css/interfont.css">
<link rel="stylesheet" href="../../css/bootstrap.min.css">  
</head>
<body>    
    <div class="loader"><img src="../../image/loader.gif"></div>  
    <div id="navigation">
        
        <div class="head">
            <h1>BCC Digital Payment System</h1>
            <div class="profile">
                <img src="../../image/avatar.jpg">
                <p>Avatar</p>
            </div>
        </div>
        

        <div class="sidebar">

            <ul class="list-inline">
                <li class="categories" id="dashboard" onclick="window.location = 'admindashboard.php'"><i class="fa-solid fa-chart-bar"></i><div class="label-text">Dashboard</div></li>
                <li class="categories" id="btn_post"><i class="fa-solid fa-bullhorn"></i>Post Announcement</li>
                <li id="usermanagement">
                    <div class="categories" id="user_management">
                        <i class="fas fa-users"></i>
                        <div class="label-text">
                            User management 
                        </div>
                    </div>
                </li>
                <li class="categories" id="back_up" onclick="window.location = 'adminback_up.php'"><i class="fa-solid fa-database"></i><div class="label-text">Back Up</div></li>
                <li class="categories" id="logout"><i class="fa-solid fa-right-from-bracket"></i><div class="label-text">Logout</div></li>
            </ul>

        </div>
        
    </div>  
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="../../js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../../js/adminnav.js"></script>

</html>
