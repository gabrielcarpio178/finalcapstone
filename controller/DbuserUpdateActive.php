<?php
require('Dbconnection.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    try {
        $sql = mysqli_query($connect, "SELECT `statues` FROM user_tb WHERE `user_id` = '$user_id';");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row['statues']=="active"){
        try {
            mysqli_query($connect, "UPDATE `user_tb` SET `statues`='not-active-account' WHERE `user_id` = '$user_id';");
            echo "success";
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($row['statues']=="not-active-account"){
        try {
            mysqli_query($connect, "UPDATE `user_tb` SET `statues`='active' WHERE `user_id` = '$user_id';");
            echo "success";
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    
}
?>