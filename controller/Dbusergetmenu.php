<?php
require('Dbconnection.php');
if(isset($_POST['id'])){
    $id = $_POST['id'];
}else{
    $firstteller_id = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `teller_id` FROM `telleruser_tb` LIMIT 1"));
    $id = $firstteller_id['teller_id'];    
}
try{
    $querycategory = mysqli_query($connect, "SELECT * FROM `category_tb` WHERE `teller_id` ='$id';");
    $category = mysqli_fetch_assoc($querycategory);
}catch(\Throwable $th){
    echo $th;
}
if(!empty($category)){
?>   
<div class="col-4 col-sm-3 col-lg-2">
    <div class="menu-purchase text-center" id="category0" onclick="getproduct(0, <?=$id ?>)">
        All
    </div>                            
</div> 
<?php do{ ?>
<div class="col-4 col-sm-3 col-lg-2">
    <div class="menu-purchase text-center" id="<?="category".$category['category_id']; ?>" onclick="getproduct(<?=$category['category_id']; ?>, <?=$id ?>)">
       <?=$category['category_name']; ?>
    </div>                            
</div> 
<?php }while($category = mysqli_fetch_array($querycategory)); }else{ ?>
<h2>No category available</h2>
<?php } ?>
