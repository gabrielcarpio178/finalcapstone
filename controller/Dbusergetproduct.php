<?php 
require('Dbconnection.php');
if(isset($_POST['category_id'])&&isset($_POST['teller_id'])){    
    $teller_id = $_POST['teller_id'];
    $category_id = $_POST['category_id'];
    if($category_id==0){
       $cot = "WHERE teller_id = ".$teller_id; 
    }else{
       $cot = "WHERE teller_id = ".$teller_id." AND category_id = ".$category_id; 
    }    
}else{
    $firstteller_id = mysqli_fetch_assoc(mysqli_query($connect, "SELECT teller_id FROM telleruser_tb LIMIT 1"));
    $teller_id = $firstteller_id['teller_id'];
    $cot = "WHERE teller_id = ".$teller_id.";";
}
try{
    $queryproduct = mysqli_query($connect, "SELECT * FROM product_tb ".$cot);
    $product = mysqli_fetch_assoc($queryproduct);
}catch(\Throwable $th){
    echo $th;
}
if(!empty($product)){
do{?>

<div class="col-6 col-sm-4 col-lg-3">
    <div class="d-flex flex-column align-items-center text-center product-info product_select_<?=$product['product_id']; ?>" id="<?=$product['product_id']; ?>" onclick="add_selectedClass(<?=$product['product_id']; ?>)">
        <div><?=$product['quantity']." pcs"; ?></div>
        <img src="../../upload/<?php echo ($product['image']!='null')? $product['image']:'TELLER_UI.png'; ?>">
        <b><?=$product['product_name']; ?></b>
        <div><?php echo sprintf("%1\$.2f", $product['price']); ?></div>                               
   </div>
</div>

<?php }while($product = mysqli_fetch_array($queryproduct)); }else{
    echo "<h1>No menu available</h1>";
} ?>
