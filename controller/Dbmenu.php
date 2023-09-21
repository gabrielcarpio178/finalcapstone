<?php
require('Dbconnection.php');
if(isset($_POST['menu_id'])&&isset($_POST['teller_id'])){
  $menu_id = $_POST['menu_id'];
  $teller_id = $_POST['teller_id'];
  if($menu_id==0){
    $id = " WHERE teller_id=".$teller_id;
  }else{
    $id = " WHERE category_id=".$menu_id." AND teller_id=".$teller_id;
  }
  try{
    $sqlproduct = mysqli_query($connect, "SELECT product_id, product_name, price, quantity, image FROM product_tb".$id);
    $product = mysqli_fetch_assoc($sqlproduct); ?>
    <div class="row">
  <?php if($product==0){
    echo "no menu available";
  }else {
  do{ ?>

  <div class="d-flex flex-row">

    <div class="d-flex flex-row justify-content-between detail w-100" id="<?=$product['product_id']; ?>">
                                  
        <div class="d-flex flex-row">
            <img src="../../upload/<?php echo ($product['image']!='null')?$product['image']:'TELLER_UI.png'; ?>" alt="" style="width: 40%; height: 10vh;">
            <div class="product-info">
                <b class="product-name"><?=$product['product_name'] ?></b>
                <div class="pcs"><?=$product['quantity'] ?> pcs</div>                                           
                <div class="d-flex flex-row gap-3 add-pcs">

                    
              </div>                                                                                                                                                                                                                               
          </div>   
        </div>
        <div class="d-flex flex-row gap-3 align-items-center">
          <b class="price"><?php echo sprintf("%1\$.2f", $product['price']); ?></b>                               
      </div>
      
    </div>
  <i class="fa-solid fa-x delete_product" id="<?=$product['product_id']; ?>"></i>
  </div>
      
    <?php }while($product = mysqli_fetch_array($sqlproduct)); }?>
    <div class="d-flex flex-row justify-content-center">
        <button class="btn btn-primary mt-2 add-prd" id="product_form">
            Add product
        </button>
    </div>
    </div>
    
 <?php   
  }catch(\Throwable $th){
    echo $th;
  }
}else{
   $id = $_SESSION['id'];
  try{
    $sqlproduct = mysqli_query($connect, "SELECT product_id, product_name, price, quantity, image FROM product_tb WHERE teller_id = '$id'");
    $product = mysqli_fetch_assoc($sqlproduct); ?>
    <div class="row">
  <?php if($product==0){
    echo "no menu available";
  }else {
  do{ ?>
  
  <div class="d-flex flex-row">

    <div class="d-flex flex-row justify-content-between detail w-100" id="<?=$product['product_id']; ?>">
                                   
        <div class="d-flex flex-row">
            <img src="../../upload/<?php echo ($product['image']!='null')?$product['image']:'TELLER_UI.png'; ?>" alt="" style="width: 40%; height: 10vh;">
            <div class="product-info">
                <b class="product-name"><?=$product['product_name'] ?></b>
                <div class="pcs"><?=$product['quantity'] ?> pcs</div>                                           
                <div class="d-flex flex-row gap-3 add-pcs">
    
                    
              </div>                                                                                                                                                                                                                               
          </div>   
        </div>
        <div class="d-flex flex-row gap-3 align-items-center">
          <b class="price"><?php echo sprintf("%1\$.2f", $product['price']); ?></b>                               
      </div>
      
  </div>
  <i class="fa-solid fa-x delete_product" id="<?=$product['product_id']; ?>"></i>
</div>

      
    <?php }while($product = mysqli_fetch_array($sqlproduct)); }?>
    <div class="d-flex flex-row justify-content-center">
        <button class="btn btn-primary mt-2 add-prd" id="product_form">
            Add product
        </button>
    </div>
    
    </div>     
 <?php   
  }catch(\Throwable $th){
    echo $th;
  }
}

?>
