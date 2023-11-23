<?php 
session_start();
require('../../controller/Dbconnection.php');
if(!isset($_SESSION['id'])&&($_SESSION['usertype']!="student"||$_SESSION['usertype']!="personnel")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
    }
}else{
    $id = $_SESSION['id'];
    $firstname = $_SESSION['firstname'];
    try{
       $query = mysqli_query($connect, "SELECT * FROM telleruser_tb;");
        $teller = mysqli_fetch_assoc($query);
    }catch(\Throwable $th){
        echo $th;
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, 
user-scalable=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/purchase.css">
    <title>BCC Digital Payment System</title>
</head>
<body>
    <div class="loader"><img src="../../image/loader.gif"></div>
    <div id="nav"></div> 
    <div class="container-fluid">
        
        <div class="row">
            <div class="col col-lg-9 info">
                <div class="d-flex flex-column">
                    
                    <div class="d-flex flex-row gy-2 justify-content-between w-100">
                            <div class="d-flex flex-column info-group">
                            <div class="purchase">PURCHASE</div>
                            <div class="canteen">Canteen</div>
                            
                        </div>
                        <div class="d-flex flex-row">
                            <div class="count-order">
                                <i class="fa-solid fa-cart-shopping cart" id="cart"></i>                 
                                <div class="number-count">0</div>
                            </div>        
                        </div>                            
                    </div>
                    
                    <div class="chooose-teller">
                        Choose Canteen Store                  
                    </div> 
                    <div class="row gx-5 gy-2">
                        <!-- teller -->
                        <?php if(!empty($teller)){ 
                        $teller_num = 0 ; ?>
                        <?php do{ ?>
                            <div class="col-4 col-sm-3 col-lg-2">
                                <div class="teller text-center" id="<?=$teller['teller_id']; ?>">
                                    <?=$teller['store_name']; ?>                                
                                </div>                            
                            </div> 
                        <?php $teller_num++;
                            }while($teller=mysqli_fetch_array($query)); ?>
                        <?php }else{ echo "<b>no teller user</b>"; } ?>
                        
                                                                    
                    </div> 
                                                                                            
                <div class="menu-label">
                    Menu
                </div>
                
                <div class="row gy-2" id="category-menu">                                                
                        <!-- category -->
                        <?php include '../../controller/Dbusergetmenu.php'; ?>                                              
                </div> 
                
                <div class="choose-order mt-3 mt-lg-5">
                    Choose Order
                </div>
                <div class="row gy-4 mt-2 mt-lg-3" id="product-list">
                <?php include '../../controller/Dbusergetproduct.php'; ?>      
                                                                                
                    
                </div>

                </div>
            </div>
            
            <div class="col col-lg-3 orders">
                <input type="hidden" value="<?=$_SESSION['id'] ?>" id="user_id">
                <input type="hidden" id="balance_amount">
                <div class="d-flex flex-column order">
                    <i class="fa-solid fa-x" id="close"></i>
                    <div class="d-flex flex-row justify-content-between profile-info mt-3 p-3">
                        <div class="d-flex flex-row profile-name image_profile">
                            <img src="<?php echo ($_SESSION['image']!=NULL)?"profile/".$_SESSION['image']:"../../image/avatar.jpg" ?>">
                            <div><?=$firstname ?></div> 
                        </div>                       
                        <i class="fa-solid fa-clipboard" id="user_order"></i>
                    </div>
                    <form id="submit_order">    
                        <div class="selected-menu">
                        <!-- order list --> 
                        </div>
                        <div class="total-amount mt-2 mb-2">
                            Total: 0.00
                        </div>       
                        <center><input type="submit" value="Checkout" class="btn btn-primary w-50"></center>   
                    </form>                                                                                                                                 
                </div>                                        

            </div>                                 
        </div>
        
    </div>       
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="../../js/purchase.js"></script>

</html>
