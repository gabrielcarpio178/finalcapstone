<?php
require('Dbconnection.php');
sleep(1);
date_default_timezone_set("Asia/Manila"); 
if(isset($_POST['product_name'])&&isset($_POST['price'])&&isset($_POST['pcs'])&&isset($_POST['addcategory'])&&isset($_POST['productteller_id'])&&isset($_POST['pp'])&&(isset($_FILES['fileImg']['name'])||!isset($_FILES['fileImg']['name']))){
    $date = date('Y-m-d');
    $product_name = $_POST['product_name'];
    $teller_id = $_POST['productteller_id'];
    $price = $_POST['price'];
    $pcs = $_POST['pcs'];
    $pp = $_POST['pp'];
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
          mysqli_query($connect, "INSERT INTO `product_tb`(`teller_id`, `category_id`, `date_post`, `product_name`, `price`, `quantity`, `producer_price`, `image`) VALUES ('$teller_id','$category','$date','$product_name','$price','$pcs', '$pp',  '$newNameImage')");
          echo "success";
        }catch(\Throwable $th){
          echo $th;
      }
    }                     
    }else{
      try{
          mysqli_query($connect, "INSERT INTO `product_tb`(`teller_id`, `category_id`, `date_post`, `product_name`, `price`, `quantity` , `producer_price`, `image`) VALUES ('$teller_id','$category','$date','$product_name','$price','$pcs','$pp', 'null')");
          echo "success";
        }catch(\Throwable $th){
          echo $th;
      } 
    }        
                            
}
?>
