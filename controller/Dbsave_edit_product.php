<?php 
require('Dbconnection.php');
sleep(1);
if(isset($_POST['product_name'])&&isset($_POST['price'])&&isset($_POST['pcs'])&&isset($_POST['addcategory'])&&isset($_POST['product_id'])&&(isset($_FILES['fileImg']['name'])||!isset($_FILES['fileImg']['name']))){
    $product_name = $_POST['product_name'];
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $pcs = $_POST['pcs'];
    $category = $_POST['addcategory'];
   
    if(!empty($_FILES['fileImg']['name'])){
        
        $imageName = $_FILES['fileImg']['name'];
        $tmpName = $_FILES['fileImg']['tmp_name'];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.',$imageName);
   
        $name = $imageExtension[0];
        $imageExtension = strtolower(end($imageExtension));
   
        if(!in_array($imageExtension, $validImageExtension)){
           echo "not_image";       
       }else{           
            $newNameImage = $name."-".uniqid();
            $newNameImage .= ".".$imageExtension;
            move_uploaded_file($tmpName, "../upload/".$newNameImage);
            try{
              mysqli_query($connect, "UPDATE `product_tb` SET `image`='$newNameImage', `product_name`='$product_name', `price`='$price', `quantity`='$pcs', `category_id`='$category' WHERE `product_id`='$product_id';");
  echo "success";
            }catch(\Throwable $th){
              echo $th;
            }        
        }
        
    }else{
    
        try{
            mysqli_query($connect, "UPDATE `product_tb` SET `product_name`='$product_name', `price`='$price', `quantity`='$pcs', `category_id`='$category' WHERE `product_id`='$product_id';");
  echo "success";
        }catch(\Throwable $th){
            echo $th;
        }
                
    }
    
        
}


?>
