<?php
require('Dbconnection.php');
if(isset($_POST['id'])&&isset($_POST['usertype'])){
    $id = $_POST['id'];
    if($_POST['usertype']=='buyer'){

        try {
            $sql = mysqli_query($connect, "SELECT `password` FROM `user_tb` WHERE `user_id`='$id';");
            $row = mysqli_fetch_assoc($sql);
        } catch (\Throwable $th) {
            echo $th;
        }
        $result = str_split($row['password']);

    }elseif($_POST['usertype']=='teller'){

        try {
            $sql = mysqli_query($connect, "SELECT `password` FROM `telleruser_tb` WHERE `teller_id`='$id';");
            $row = mysqli_fetch_assoc($sql);
        } catch (\Throwable $th) {
            echo $th;
        }
        $result = str_split($row['password']);

    }
    
    $letters = range('a', 'z');
    // $numbers = range('0', '9');
    $array_letters = array();
    $array_numbers = array();
    for($a = 0; $a < count($result) ; $a++){
        $x = false;
        for($i = 0; $i < count($letters); $i++){
        if($result[$a]==$letters[$i]){
            $x = true;          
        }
        }
        if($x==true){
            array_push($array_letters, $result[$a]); 
            $x = false;
        }else{
            array_push($array_numbers, $result[$a]);  
            $x = false;
        }
        
    }

    $reset_code = implode("",array_slice($array_numbers, 0, 10));
    echo $reset_code;
    
    
}
?>