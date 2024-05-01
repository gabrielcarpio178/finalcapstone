<?php
session_start();
require('Dbconnection.php');
if(isset($_POST['product_id'])){
    $product_id = $_POST['product_id'];
    $teller_id = $_SESSION['id'];   
    try{
    
        $select = mysqli_query($connect,"SELECT product_tb.*, category_tb.category_id, category_tb.category_name FROM `product_tb` INNER JOIN `category_tb` ON product_tb.category_id = category_tb.category_id WHERE product_tb.teller_id = '$teller_id' AND product_tb.product_id = '$product_id';");
        $productrow = mysqli_fetch_assoc($select);
       // print_r($productrow);
       $category = mysqli_query($connect,"SELECT category_name, category_id FROM category_tb WHERE teller_id='$teller_id'");
       $categoryrow = mysqli_fetch_assoc($category);
        
    }catch(\Throwable $th){
       echo $th;
    }
    
}

?>

<style>
   form input{
        background-color: #F2f2f2;
    }
    .loader{
        display: none;
        position: fixed;        
        margin: 0px;
        padding: 0px;
        top: 0px;
        left: 0px;
        right: 0px;
        bottom: 0px;
        width: 100%;
        height: 100vh;
        background-color: #fff;
        z-index: 30001;
        opacity: 0.8;
    }
    .loader img{
        position: absolute;
        margin: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
</style>
<form id="add_product_edit" enctype="multipart/form-data" method="POST">
    <input type="hidden" value="<?=$productrow['product_id'] ?>" name="product_id" id="productteller_id">    
    <div class="d-flex flex-column">
        <div class="d-flex flex-row justify-content-between">
            <header>Edit Product</header>
            <i class="fa-solid fa-x" onclick="close_category();" style="cursor: pointer;" id="close"></i>
        </div>         
        <div class="d-flex flex-column justify-content-center">
            <img src="../../upload/<?php echo ($productrow['image']!='null')?$productrow['image']:"TELLER_UI.png"; ?>" alt="Preview" id="img" style="max-height: 100px;">
            <input type="file" name="fileImg" id="fileImg">
        </div>   
        <label for="product_name">Product name</label>
        <input type="text" name="product_name" id="product_name" value="<?=$productrow['product_name']; ?>">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" value="<?=$productrow['price']; ?>">
        <label for="pcs">Pieces</label>
        <input type="number" name="pcs" id="pcs" value="<?=$productrow['quantity']; ?>">
        <label for="pp">Whole Sale Price</label>
        <!-- <input type="number" name="pp" id="pp" value="<?=$productrow['producer_price']; ?>"> -->
        <div class="d-flex flex-column">
            <label for="addcategory">Category</label>
            <select name="addcategory" id="addcategory">
           <?php if(empty($category)){
             echo "<option>empty category</option>";
           }else{ ?>
             
         <?php do{ ?>
           <option value="<?=$categoryrow['category_id']; ?>" <?php echo ($productrow['category_name']==$categoryrow['category_name'])?"selected":""; ?> ><?=$categoryrow['category_name']; ?></option>
           <?php }while($categoryrow = mysqli_fetch_array($category)); ?>
       
         <?php } ?>
        </div>
        <center><input type="submit" value="save" class="btn btn-primary w-100 mt-5"></center>
    </div>                   
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

fileImg.onchange = event =>{
        const [file]=fileImg.files;
        if(file){
            img.src=URL.createObjectURL(file);
        }
    }
    
$(document).ready(function(){
    
    $("#add_product_edit").on('submit', function(e){
        e.preventDefault();
        
        var values=$(this)[0];           
        var formData = new FormData(values); 

        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../controller/Dbsave_edit_product.php',
                    type: 'post',
                    data: formData,             
                    contentType: false,
                    processData: false,
                    cache: false,
                    beforeSend: function(){
                        $(".loader").show(); 
                    },
                    success:function(res){
                        $(".loader").hide();
                        if(res=="success"){

                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Edit product.',
                                showConfirmButton: false,
                                timer: 1000
                            }).then(function() {
                                window.location = "teller_menu.php";
                            }); 
                            
                            
                        }else if(res=="not_image"){

                            Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: 'insert file not image!',
                                showConfirmButton: false,
                                timer: 1000
                            });
                                
                        }     
                    }    
                });            
            } else if (result.isDenied) {
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Changes are not saved',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        })
        
    });    
            
});
    
</script>


