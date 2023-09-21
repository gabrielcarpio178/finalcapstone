<?php
require("Dbconnection.php");
sleep(1);
if(isset($_POST['reset_code'])){
    $input_reset = $_POST['reset_code']; 
    try {
        $sql = mysqli_query($connect, "SELECT user_id , password FROM `user_tb`");
    } catch (\Throwable $th) {
        echo $th;
    }

    $password = array();
    $id = array();
    while($row = mysqli_fetch_assoc($sql)){
        $password[] = array($row['user_id'] => $row['password']);
        $id[] = $row['user_id'];
    }

    $reset_codes =  array();
    for($y = 0; $y < count($id); $y++){
        $result = str_split($password[$y][$id[$y]]);
        $letters = range('a', 'z');
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
        $reset_codes[] = array($id[$y] => implode("",array_slice($array_numbers, 0, 10)));
        
    }
    $valid = false;
    $user_id;
    for($z = 0; $z < count($reset_codes); $z++){
        
        if($reset_codes[$z][$id[$z]]==$input_reset){
            $user_id = $id[$z];
            $valid = true;
            break;
        }
        
    }

    if($valid == true){
        echo $user_id;
    }else{
        echo 'invalid';
    }

    

    
}

?>