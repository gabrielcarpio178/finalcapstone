<?php
require('../../controller/Dbconnection.php');
$id = $_POST['id'];
$sql = mysqli_query($connect, "SELECT category_id, category_name FROM category_tb WHERE category_id = '$id'");
$categoryinfo = mysqli_fetch_assoc($sql);
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
<form id="edit_category" method="post">
    <div class="d-flex flex-column p-2 mt-2">
        <div class="d-flex flex-row justify-content-between">
            <header>Add Category</header>
            <i class="fa-solid fa-x" onclick="close_category();" style="cursor: pointer;" id="close"></i>
        </div>         
         <input type="hidden" name="category_id" id="category_id" value="<?=$categoryinfo['category_id'] ?>">
         <input type="text" name="category_name" id="category_name" class="mt-2" value="<?=$categoryinfo['category_name'] ?>">
         <center>
             <input type="submit" id="categorybtnedit" name="categorybtn" value="edit category" class="btn btn-primary w-75 mt-5">
         </center>
    </div>  
</form>
 

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>     
    $(document).ready(function(){
       
       //edit category
       $("#edit_category").on('submit', function(e){
           e.preventDefault();
           var category_id = $("#category_id").val();
           var category_name = $("#category_name").val();
           if(category_name.length==0){
               Swal.fire(
                   'Warning',
                   'Messing input',
                   'warning'
              );
           }else{
                 Swal.fire({
                    title: 'Do you want to save the changes?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '../../controller/Dbsaveeditcategory.php',
                            type: 'POST',
                            data: {
                                category_id : category_id,
                                category_name : category_name
                            },
                            cache: false,
                            beforeSend: function () {
                                $(".loader").show();
                            },
                            success: function(res){
                                $(".loader").hide();
                                
                                if(res=="success"){

                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'Edit category.',
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(function() {
                                        window.location = "teller_menu.php";
                                    });
            
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire({
                            position: 'center',
                            icon: 'info',
                            title: 'Changes are not saved!',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                })
           }
           
       }); 
          
    })     
</script>   


