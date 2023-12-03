<?php
session_start();
require('Dbconnection.php');
if(isset($_POST['product_id'])){
    $product_id = $_POST['product_id'];
    $id = $_SESSION['id'];
    try{
        $sql = mysqli_query($connect, "SELECT product_tb.product_id, product_tb.product_name, category_tb.category_name, product_tb.price, product_tb.quantity, product_tb.image, telleruser_tb.teller_id, telleruser_tb.store_name FROM telleruser_tb JOIN category_tb ON telleruser_tb.teller_id = category_tb.teller_id JOIN product_tb ON category_tb.category_id = product_tb.category_id WHERE product_tb.product_id = '$product_id';");
        $order = mysqli_fetch_assoc($sql);       
    }catch(\Throwable $th){
        echo $th;
    }
}
?>
<div class="d-flex flex-row justify-content-between align-items-center w-100 p-2 order-list" id="product_<?=$product['product_id']; ?>">
    <img src="../../upload/<?php echo ($order['image']!='null')? $order['image']:'TELLER_UI.png'; ?>">
    <div class="d-flex flex-column order-name">
        <b><?=$order['product_name']; ?></b>
        <div class="order-info"><?=$order['category_name'] ?>, <?=$order['store_name']; ?></div> 
    </div>
        <div class="d-flex flex-row justify-content-between w-50 price">
            <div class="items-price mt-1"><?php echo sprintf("%1\$.2f", $order['price']); ?></div>
            <input type="hidden" name="user_id[]" value="<?=$id; ?>">
            <input type="hidden" name="product_id[]" value="<?=$order['product_id']; ?>">
            <input type="hidden" name="category[]" value="<?=$order['category_name']; ?>">
            <input type="hidden" name="teller_id[]" value="<?=$order['teller_id']; ?>">
            <input type="hidden" name="product_name[]" value="<?=$order['product_name']; ?>">
            <input type="hidden" name="price[]" id="price_<?=$order['product_id'] ?>" value="<?=$order['price']; ?>">
            <div class="d-flex flex-row align-items-center w-50">

            <div class="minus minus_<?=$order['product_id'] ?>" id="<?=$order['product_id'] ?>" onclick="minusquantity(<?=$order['product_id'] ?>)">-</div>

            <div class="input-amount"><input type="number" name="qty[]" id="numqty_<?=$order['product_id'] ?>" class="input_qty  w-100" value="1" min="1" max="<?=$order['quantity']+1 ?>" onkeyup="total_amount()" readonly></div>

            <div class="plus plus_<?=$order['product_id'] ?>" id="<?=$order['product_id'] ?>" name ="<?=$order['quantity'] ?>" onclick="addquantity(<?=$order['product_id'] ?>)">+</div>
                                    
        </div>
    </div> 
    <i class="fa-solid fa-x mr-5 <?=$order['product_id']; ?>" id="cancel" name="<?=$order['product_id']; ?>"></i>                            
</div>

