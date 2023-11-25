<?php
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="admin")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> -->
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/interfont.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">   
    <link rel="stylesheet" href="../../css/adminusermanagement.css">
    <title>User management</title>
</head>
<body>
    <div id="nav"></div>

    <div class="content">

        <div class="title-page">
            <h2>User Management</h2>
            <input type="text" name="search" id="search" class="form-control w-25" placeholder="Search">
        </div>

        <div class="btns d-flex flex-row justify-content-between p-3">
            <div class="info">

                <div class="label">
                    Departments
                </div>
                <div class="addteller">
                    <button class="btn btn-primary" id="btn_adduser" data-toggle="modal" data-target="#addteller"><i class="fa-solid fa-plus"></i> Add Canteen Staff</button>
                </div>
                <div class="filter-btn">
                    <ul class="ul-list">
                        <li>
                            <select name="filter" id="filter" class="form-select">
                                <option disabled selected>Sort By</option>
                                <option value="ALL">ALL</option>
                                <option value="bago">Bago City</option>
                                <option value="non-bago">Non-Bago</option>
                            </select>
                        </li>
                    </ul>
                </div> 

            </div>

            <div class="add-row">
                <select name="add_row" id="add_row" class="form-select">
                    <option disabled selected>Number of row</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
                <!-- <input type="number" name="add_row" id="add_row" placeholder="number of row" min="1" class="form-control"> -->
            </div>

        </div>

        <div class="data-info">

            <div class="number-of-data">

                <div class="data all" id="All" name="all">
                    <div class="label label-all">
                        ALL
                    </div>
                    <div class="num-all">
                        
                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>
                <div class="data bsis" id="BSIS" name="student">
                    <div class="label label-bsis">
                        BSIS
                    </div>
                    <div class="num-bsis">
                        
                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>
                <div class="data bscrim" id="BSCRIM" name="student">
                    <div class="label label-bscrim">
                        BSCrim
                    </div>
                    <div class="num-bscrim">
                        
                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>
                <div class="data bsed" id="BSED" name="student">
                    <div class="label label-bsed">
                        BSED
                    </div>
                    <div class="num-bsed">

                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>
                <div class="data beed" id="BEED" name="student">
                    <div class="label label-beed">
                        BEED
                    </div>
                    <div class="num-beed">

                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>
                <div class="data bsoa" id="BSOA" name="student">
                    <div class="label label-bsoa">
                        BSOA
                    </div>
                    <div class="num-bsoa">

                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>
                <div class="data registrar" id="Registrar" name="personnel">
                    <div class="label label-registerar">
                        Registrar
                    </div>
                    <div class="num-registerar">

                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>
                <div class="data saso" id="SASO" name="personnel">
                    <div class="label label-saso">
                        SASO
                    </div>
                    <div class="num-saso" name="personnel">

                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>
                <div class="data ssg" id="SSG" name="personnel">
                    <div class="label label-ssg">
                        SSG
                    </div>
                    <div class="num-ssg">

                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>
                <div class="data admin" id="ADMIN" name="personnel">
                    <div class="label label-admin">
                        ADMIN
                    </div>
                    <div class="num-admin">

                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>

                <div class="data guidance" id="Guidance" name="personnel">
                    <div class="label label-guidance">
                        Guidance
                    </div>
                    <div class="num-guidance">

                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>

                <div class="data faculty" id="Faculty" name="personnel">
                    <div class="label label-faculty">
                        Faculty
                    </div>
                    <div class="num-faculty">

                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>

                <div class="data teller" id="teller" name="teller">
                    <div class="label label-teller">
                        Canteen Staff
                    </div>
                    <div class="num-teller">

                    </div>
                    <div class="num-label">
                        Total number of users
                    </div>
                </div>

            </div>

            <div class="table-info w-75">

            </div>
        </div>


        


    </div>

    <!-- modal -->

    <div class="modal fade" id="addteller" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sign Up Canteen Staff</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_teller">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                    </div>

                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                    </div>

                    <div class="mb-3">
                        <label for="phonenumber" class="form-label">Phonenumber</label>
                        <input type="number" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phonenumber">
                        <div class="invalid-feedback" id="message">Sorry, input phone number is to short</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>

                    <div class="d-flex flex-row justify-content-between mb-3">
                        <div class='w-50'>
                            <label for="storename" class="form-label">Store Name</label>
                            <input type="text" class="form-control" id="store_name" name="store_name" placeholder="Store Name">
                        </div>

                        <div class='w-50'>
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-select">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>

                    <div class="mb-3">
                        <label for="confirm_pass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="Confirm Password">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Sign Up" class="btn btn-primary" >
                </div>
            </form>
            </div>
        </div>
    </div>

    
</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script> -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/adminusermanagement.js"></script>
</html>
