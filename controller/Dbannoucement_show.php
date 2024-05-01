<?php
require('Dbconnection.php');
if(isset($_POST['usertype'])){
    $usertype = $_POST['usertype'];
    try {
        $sql = mysqli_query($connect, "SELECT post, post_date, post_type FROM adminannoucement WHERE posted = 'active';");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    $annoucement;
    if(!empty($row)){
        if($row['post_type']==$usertype||$row['post_type']=="All"){
            $annoucement = $row['post'];
        }elseif($row['post_type']!=$usertype){
            $annoucement = "Welcome!";
        }
    }else{
        $annoucement = "Welcome!";
    }

    echo ucfirst($annoucement);
    

    
}

?>