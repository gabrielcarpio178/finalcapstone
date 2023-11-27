<?php
session_start();
$id = $_SESSION['id'];
$name = $_SESSION['teller_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, 
user-scalable=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../../css/storenav.css">
<link rel="stylesheet" href="../../css/interfont.css">
</head>
<body>    
    <div class="loader"><img src="../../image/loader.gif"></div>  
    <div id="sidebar">
        
        <div class="profile">
            <img class="profile-img" src="../../image/<?php echo ($_SESSION['gender']=='male')?'avatar.jpg':'female_avatar.png'; ?>" alt="profile" class="rounded" >

            <div class="store_name">
                <small class="store_name_label">Store Name</small>
                <div class="user_name"><?=ucfirst($name); ?></div>
            </div>
        </div>
                                                
        <ul class = "list-inline">                    
           <li id="home" class="view"><a href="#" class="view_a"><i class="fas fa-home"></i>  <span>Home</span></a></li>
           <li id="icon_menu" class="view"><a href="#" id="menu" class="view_a"><i class="fa-solid fa-bars" id="burger"></i> <span>Menu</span></a></li>
           
           <li id="order" class="view"><a href="#" id="cart" class="view_a"><i class="fa-solid fa-cart-shopping cart"></i> <span>Order</span></a></li>
           
           <li id="cash" class="view"><a href="#" class="view_a"><i class="fa-solid fa-peso-sign peso"></i> <span>Cash out</span></a></li>         
                             
           <li id="history" class="view"><a href="#" class="view_a"><i class="fa-solid fa-clock-rotate-left"></i>  <span>History</span></a></li>      
                                                            
           <li id="logout" class="view"><a href="#" class="view_a"><i class="fa-solid fa-right-from-bracket"></i>  <span>Logout</span></li>                    
        </ul>
        
    </div>      
                     
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../js/storenav.js"></script>

</html>
