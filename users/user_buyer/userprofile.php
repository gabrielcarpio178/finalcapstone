<?php
session_start();
require('../../controller/Dbconnection.php');
if(!isset($_SESSION['id'])&&($_SESSION['usertype']!="student"||$_SESSION['usertype']!="personnel")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
    }
}
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../../css/userprofile.css"> 
</head>
<body>
    <div id="navbar"></div>
        <div class="content w-75">
            <div class="label">
                <h2>Profile</h2> 
            </div>
            <form id="edit_form" enctype="multipart/form-data">
                <div class="row  mt-3 profile-info justify-content-center align-items-center ">
                    <div class="col-4 d-flex flex-column profile-image">
                        <div class="d-flex flex-column align-items-center">
                            <div id="edit_icon" class="text-center align-self-start">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="d-flex flex-column align-items-center profile_camera w-100">
                                <img src="" id="profile_img">
                                <img src="../../image/camera.png" class="camera_icon">
                            </div>
                            
                            <label for="name"><h2 id="profile_name"></h2></label>
                            <div class="d-flex flex-row">
                                <input type="text" value="" id="firstname" name="firstname" class="form-control">
                                <input type="text" value="" id="lastname" name="lastname" class="form-control">
                                <input type="file" id="upload_profile" name="upload_profile">
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center justify-content-center profile-group w-100">
                            <label for="stud_id" >STUDENT ID: </label>
                            <input type="text" id="stud_id" name="stud_id" placeholder="" class="form-control w-50" disabled>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-4 p-3 col-8">

                        <div class="row">
                            <div class="col-6">
                                <label for="year">Year:</label>
                                <select name="year" id="year" class="form-control" disabled>
                                    <option value="1st"  id="1st">1st</option>
                                    <option value="2nd" id="2nd">2nd</option>
                                    <option value="3rd" id="3rd">3rd</option>
                                    <option value="4th" id="4th">4th</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="gender">Gender:</label>
                                <select name="gender" id="gender" class="form-control" disabled>
                                    <option value="male" id="male">MALE</option>
                                    <option value="female" id="female">FEMALE</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="" disabled>
                            </div>
                            <div class="col-6">
                                <label for="p_num" >Phone Number:</label>
                                <input type="text" id="p_num" name="p_num" class="form-control" placeholder="" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <button style="display: none;" id="saveedit" type="submit">submit</button>
            </form>
            <div class= "mt-3 w-100">
                <button class="btn btn-primary w-100" id="show_change_pass">Change Password</button>
                <form id="change_pass">
                    <div class="d-flex flex-column gap-2 mt-2 change-pass p-3">
                        <div class="d-flex flex-row justify-content-between">
                            <label for="old_password">OLD PASSWORD: </label>
                            <input id="old_password" class="form-control w-50" type="password">
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <label for="new_password">NEW PASSWORD: </label>
                            <input id="new_password" class="form-control w-50" type="password">
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <label for="confirm_password">CONFIRM PASSWORD: </label>
                            <input id="confirm_password" class="form-control w-50" type="password">
                        </div>
                        <div class="d-flex flex-row justify-content-center w-100">
                            <button type="submit" class="btn btn-primary w-25">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="../../js/userprofile.js"></script>

</html>