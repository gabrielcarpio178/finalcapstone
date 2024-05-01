<?php
require('Dbconnection.php');
sleep(1);

if(isset($_POST['edit_post'])&&isset($_POST['edit_post_to'])&&isset($_POST['id'])&&isset($_POST['posted'])){
    $edit = $_POST['edit_post'];
    $post_to = $_POST['edit_post_to'];
    $id = $_POST['id'];
    $posted = $_POST['posted'];
    

    if($posted=='active'){
        try {
            mysqli_query($connect, "UPDATE `adminannoucement` SET `posted`='not-active';");
            mysqli_query($connect, "UPDATE `adminannoucement` SET `post`='$edit',`post_type`='$post_to', `posted`='active' WHERE announcement_id='$id';");
            echo "success";
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($posted=='not-active'){
        try {
            mysqli_query($connect, "UPDATE `adminannoucement` SET `post`='$edit',`post_type`='$post_to' WHERE announcement_id='$id';");
            echo "success";
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    
}
?>