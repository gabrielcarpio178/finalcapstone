<?php 
require('Dbconnection.php');
if(isset($_POST['id'])){
    $id = $_POST['id'];
    try {
        $sql = mysqli_query($connect, "SELECT announcement_id, post, post_type FROM adminannoucement WHERE announcement_id='$id';");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
}

print_r(json_encode($row));
?>
