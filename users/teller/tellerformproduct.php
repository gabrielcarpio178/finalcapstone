<?php
session_start();
require('../../controller/Dbconnection.php');
$teller_id = $_SESSION['id'];
try{
  $sql = mysqli_query($connect, "SELECT category_name, category_id FROM category_tb WHERE teller_id='$teller_id'");
  $row = mysqli_fetch_assoc($sql);
}catch(\Throwable $th){
  echo $th;
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

<!-- add product -->
<div class="loader"><img src="../../image/loader.gif"></div>   
<form id="add_product" enctype="multipart/form-data" method="POST">
    <input type="hidden" value="<?=$teller_id ?>" name="productteller_id" id="productteller_id">
    <div class="d-flex flex-column">
        <div class="d-flex flex-row justify-content-between">
            <header>Add Product</header>
            <i class="fa-solid fa-x" onclick="close_category();" style="cursor: pointer;" id="close"></i>
        </div>         
        <div class="d-flex flex-column justify-content-center">
            <img src="../../image/TELLER_UI.png" alt="Preview" id="img">
            <input type="file" name="fileImg" id="fileImg">
        </div>   
        <label for="product_name">Product name</label>
        <input type="text" name="product_name" id="product_name">
        <label for="price">Price</label>
        <input type="number" name="price" id="price">
        <label for="pcs">Pieces</label>
        <input type="number" name="pcs" id="pcs">
        <label for="pp">Whole Sale Price</label>
        <input type="number" name="pp" id="pp">
        <div class="d-flex flex-column">
            <label for="addcategory">Category</label>
            <select name="addcategory" id="addcategory">
           <?php if(empty($row)){
             echo "<option>empty category</option>";
           }else{ ?>
             
         <?php do{ ?>
           <option value="<?=$row['category_id']; ?>"><?=$row['category_name']; ?></option>
           <?php }while($row = mysqli_fetch_array($sql)); ?>
       
         <?php } ?>
        </div>
        <center><input type="submit" value="Add product" class="btn btn-primary w-100 mt-5"></center>
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
    
        $("#add_product").on('submit', function(e){
            e.preventDefault();
            var product_name = $("#product_name").val();
            var price = $("#price").val();
            var pcs = $("#pcs").val();
            var pp = $("#pp").val();
            var sp = $("#sp").val();
            if(product_name.length==0&&price.length==0&&pcs.length==0&&pp.length==0&&sp.length==0){

                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Messing input!',
                    showConfirmButton: false,
                    timer: 1000
                });

            }else{
                
                var values=$(this)[0];           
                var formData = new FormData(values);                  
                $.ajax({
                    url: '../../controller/Dbadd_product.php',
                    type: 'post',
                    data: formData,             
                    contentType: false,
                    processData: false,
                    cache: false,
                    beforeSend: function(){
                        $(".loader").show();
                    },
                    success: function(res){ 
                    //console.log(res);                  
                    if(res=="success"){
                        $(".loader").hide();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Add product.',
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
                         
           }
       });
                                                                        
            
    });
            
    
</script> 



