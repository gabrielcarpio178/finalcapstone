<?php
require('Dbconnection.php');
sleep(1);
if(isset($_POST['category'])&&isset($_POST['teller_id'])){
    $category = $_POST['category'];
    $teller_id = $_POST['teller_id'];
try{
  mysqli_query($connect, "INSERT INTO `category_tb`(`category_name`, `teller_id`) VALUES ('$category', '$teller_id')");
  echo "success";
}catch(\Throwable $th){
  echo $th;
}
}


 ?>
