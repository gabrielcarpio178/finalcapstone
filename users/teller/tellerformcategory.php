<?php
session_start();
$id=$_SESSION['id'];
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
<!-- add category -->
<div class="loader"><img src="../../image/loader.gif"></div>   
<form id="add_category" method="post">
    <div class="d-flex flex-column p-2 mt-2">
        <div class="d-flex flex-row justify-content-between">
            <header>Add Category</header>
            <i class="fa-solid fa-x" onclick="close_category();" style="cursor: pointer;" id="close"></i>
        </div>         
         <input type="hidden" name="teller_id" id="teller_id" value="<?=$id ?>">
         <input type="text" name="category" id="category" class="mt-2">
         <center>
             <input type="submit" id="categorybtn" name="categorybtn" value="add category" class="btn btn-primary w-75 mt-5">
         </center>
    </div>  
</form>
 

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>     
    $(document).ready(function(){
       
       //add category     
         $("#add_category").submit(function(e){
             e.preventDefault();
             var category= $("#category").val();   
             var teller_id= $("#teller_id").val();            
              if(category.length==0){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Messing input!',
                    showConfirmButton: false,
                    timer: 1000
                });
            }else{            
             $.ajax({                    
                 url: '../../controller/Dbadd_category.php',
                 type: 'POST',
                 data: {
                     category : category,
                     teller_id : teller_id
                 },
                 cache: false,
                 beforeSend: function(){
                     $(".loader").show();
                 },
                 success: function(res){
                    $(".loader").hide();
                    if(res=="success"){

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Add category.',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function() {
                            window.location = "teller_menu.php";
                        });  
                                          
                    }
                    
              }           
          });               
       }
         });
        
    });    
</script>   


