<?php 
session_start();
sleep(1);
 require('Dbconnection.php');
 if(isset($_POST['result'])){

    $result = $_POST['result'];

    try {
        $sql = mysqli_query($connect, "SELECT teller_id, store_name FROM telleruser_tb WHERE teller_qr = '$result'");
        $row = mysqli_fetch_assoc($sql);
        if(!empty($row)){
            print_r(json_encode($row));
        }else{
            echo "not_found";
        }
        
    } catch (\Throwable $th) {
        echo $th;
    }

 }
?>