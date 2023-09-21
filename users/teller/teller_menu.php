<?php
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="teller")){
   if(!isset($_SERVER['HTTP_REFERER'])){
       header('location: ../../index.php');
    exit;
   }
}
$teller_id = $_SESSION['id'];
$name = $_SESSION['teller_name'];
try{
  $sqlcategory = mysqli_query($connect, "SELECT category_name, category_id FROM category_tb WHERE teller_id='$teller_id'");
  $category = mysqli_fetch_assoc($sqlcategory);
   $sqlproduct = mysqli_query($connect, "SELECT product_id, product_name, price, quantity, image FROM product_tb WHERE teller_id='$teller_id'");
  $product = mysqli_fetch_assoc($sqlproduct);
}catch(\Throwable $th){
  echo $th;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../../css/bootstrap.min.css">   
  <link rel="stylesheet" href="../../css/teller_menu.css">
  <title>teller</title>
</head>
<body> 
  <div id="nav"></div>  
  
   <div class="container-fluid">
           
       <div class="content">
           
           <div class="row">
               
               <div class="col-lg-8">
                   <div class="d-flex flex-column product_list">
                       
                       <div class="main-menu">MENU</div>                                              
                       <div class="d-flex flex-row justify-content-between">
                        
                           <div>CATEGORY</div>
                           <div class="d-flex flex-row justify-contant-between action-category">
                                <div class="edit">
                                    <i class="fas fa-edit" style="#282828de"></i>
                                </div>
                                <div class="delete">
                                    <i class="fa-solid fa-trash" style="#282828de"></i>
                                </div>                                             
                            </div>                               
                                   
                       </div>
                       <div class="category">
                           
                         <div class="row mt-2">
                             <?php if(empty($category)){ ?>
                                <h1>No  Available</h1>
                                <div class="d-flex flex-column category-content" id="add_category_form">                                   
                                   Add                                     
                             </div>
                           <?php }else{ ?>
                             <div class="col-4 col-md-3 col-lg-2 category-div category-info" >
                                 <div class="d-flex flex-column category-content classfocus btnall" onclick="category_menu(0, <?=$teller_id; ?>)" id="0">                                   
                                   All Item                                     
                                 </div>
                                 
                             </div>
                             <?php do{ ?>
                             <div class="col-4 col-md-3 col-lg-2 category-info" >
                                 <div class="category-teller">
                                     <div class="d-flex flex-column category-content" id="<?= $category['category_id']; ?>">                                                                 
                                         <div onclick="category_menu(<?=$category['category_id'] ?>, <?=$teller_id; ?>)" class="select_category"><?=$category['category_name']; ?></div>                                     
                                     </div>
                                     <div class="edit-delete-category">
                                         <i class="fas fa-edit edit-category" style="#282828de" id="<?=$category['category_id']; ?>"></i>
                                         <i class="fa-solid fa-trash delete-category" style="#282828de" id="<?=$category['category_id']; ?>"></i>
                                         
                                     </div>
                                 
                                     
                                 </div>
                                                                                               
                             </div>
                             <?php }while($category = mysqli_fetch_array($sqlcategory)); ?>
                             <div class="col-4 col-md-3 col-lg-2 btnaddcategory">
                                 <div class="d-flex flex-column category-content category-info" id="add_category_form">                                   
                                   Add                                     
                             </div>                                   
                              </div>
                                                          
                             <?php } ?>
                             
                             
                         </div>
                           
                       </div> 
                       
                       <div class="menu">
                           
                           <div class="d-flex flex-row justify-content-between">
                               <div>Menu</div>
                               <div class="d-flex flex-row action">
                                   <div class="edit">
                                       <i class="fas fa-edit" style="#282828de"></i>
                                    </div>
                                   <div class="delete">
                                       <i class="fa-solid fa-trash" style="#282828de"></i>
                                    </div>                                                                                                                                  
                               </div>     
                               
                                                                                       
                           </div>
                           
                           <div class="details">
                               <?php include '../../controller/Dbmenu.php'; ?>
                              
                       
                               
                               
                               
                           </div>
                           
                       </div>                       
                                                                                             
                   </div>                                                                            
               </div>
               
               <div class="col-lg-4 add-form">
                   
                    <div class="forms">
                       
                   </div><!-- end of form -->
                   
               </div>
               
               
           </div> 
                                              
       </div>             
    </div>
  
  
</body>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
 <script src="../../js/teller_menu.js"></script>
</html>
<script>
    $("#nav").load("storenav.php");
    $(".forms").load("tellerformproduct.php");
</script>