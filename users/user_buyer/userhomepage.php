<?php
session_start();
require('../../controller/Dbconnection.php');
if(!isset($_SESSION['id'])&&($_SESSION['usertype']!="student"||$_SESSION['usertype']!="personnel")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
   }
}else{
    $gender = $_SESSION['gender'];
    $id = $_SESSION['id'];
    $usertype = $_SESSION['usertype'];
    $table;
    $tablerow;
    $userid;
    if($usertype=="student"){
        $table = "student_tb";
        $tablerow = "student_tb.*";
        $userid = "student_tb.user_id";
    }else if($usertype=="personnel"){
        $table = "personnel_tb";
        $tablerow = "personnel_tb.*";
        $userid = "personnel_tb.user_id";
    }
    
    try{
        $getuser = mysqli_query($connect, "SELECT user_tb.*, ".$tablerow." FROM user_tb INNER JOIN ".$table." ON user_tb.user_id = ".$userid." WHERE user_tb.user_id='$id'");
        $row = mysqli_fetch_assoc($getuser);
    }catch(\Throwable $th){
        echo $th;
    }

}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>BCC Digital Payment System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../../css/userhomepage.css">
</head>
<body>
    <div id="navbar"></div>
    
    <div class="container-fluid">
        
        <div class="row">

            <div class="col col-lg-8 info">
                
                    <div class="d-flex flex-row justify-content-end w-100 btn-profile">
                    
                    <div class="d-flex flex-column align-items-center profile-icon">
                        <img src="../../image/<?php echo ($gender=='male')?'avatar.jpg':'female_avatar.png'; ?>">
                        <div><?=$row['firstname'] ?></div>
                    </div>
                    
                </div>
                
                <div class="d-flex flex-column-reverse flex-lg-row mt-lg-5 categories">

                    <div class="notification-bell">
                        <input type="hidden" value="<?=$id ?>" id="user_id">
                        <div class="bell">
                            <i class="fa-solid fa-bell"></i>
                            <div class="count-number"></div>
                        </div>

                        <div class="notification">
                            <div class="noti-label">
                                <center><h3>Notification</h3></center>
                            </div>
                            <div class="noti-data">
                                
                            </div>
                            <div class="button">
                                Clear Notification
                            </div>
                        </div>

                        

                    </div>

                    
                    <div class="d-flex flex-row flex-lg-column justify-content-around">
                        
                        <div class="d-flex flex-column category" id="inputpayment">
                            <img src="../../image/inputpayment.png" alt="Input payment">
                            <div class="label">
                                Input Payment
                            </div>                           
                        </div>
                        <div class="d-flex flex-column category" id="purchase">
                            <img src="../../image/store.png" alt="Purchase">
                            <div class="label">
                                Purchase
                            </div>                           
                        </div>
                        <div class="d-flex flex-column category" id="accountbalance">
                            <img src="../../image/accountbalance.png" alt="Account balance">
                            <div class="label">
                                Account Balance
                            </div>                           
                        </div>
                        <div class="d-flex flex-column category" id="scanqr">
                            <img src="../../image/qrcode.png" alt="Scan Qr">
                            <div class="label">
                                Scan QR
                            </div>                           
                        </div>                         
                        
                    </div>                    
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column anouncement">
                            
                            <div class="d-flex flex-row justify-content-between align-items-end announce">
                                <h1 id="annoucement"></h1>
                                <img src="../../image/icon_1.png" alt="Logo">
                                
                                
                            </div>
                            <p class="name">
                                BCC Digital Payment System
                            </p>   
                                                                                
                        </div>  
                        
                        <div class="d-flex flex-column justify-content-center align-items-center wallet-balances">
                            <div class="d-flex flex-column justify-content-center align-items-center wallet-balance">
                                <div class="wallet">
                                    WALLET BALANCE
                                </div>
                                <div class="balance">
                                    <h1 class="balance_amount"></h1>
                                
                                </div>
                                
                            </div>                                              
                        </div>                                                                    
                        
                    </div>
                    
                </div>
                
            </div>
            
            <div class="col col-lg-4" id="profile"> 
                
                <div class="profile-data">
                    <div class="d-flex flex-row justify-content-end">
                        <i class="fa-solid fa-x" style="cursor: pointer;" id="close"></i>                       
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row align-items-center icon">
                            <img src="../../image/avatar.jpg" alt="Profile Picture">
                            <div class="d-flex flex-column">
                                <b><?=ucfirst($row['firstname'])." ".ucfirst($row['lastname']) ?></b>
                                <p><?php if($row['usertype']=='student'){ ?>
                                Student ID: <?=$row['studentID_number'] ?>
                                <?php }else{ ?>
                                Personnel ID: <?=$row['personnelUser_id']?> 
                                <?php } ?>
                                </p>
                                
                            </div>
                        </div>
                        <?php if($row['usertype']=='personnel'){ ?>
                        <div class="profile-info">
                            <label>Department:</label>
                            <b><?=$row['department'] ?></b>
                        </div>
                        <?php } ?>
                        <?php if($row['usertype']=='student'){ ?>
                        <div class="profile-info">
                            <label>Course:</label>
                            <b><?=$row['course'] ?></b>
                        </div>
                        <?php }elseif($row['usertype']=='personnel'){ ?>
                            <div class="profile-info">
                            <label>Email:</label>
                            <b><?=$row['email'] ?></b>
                        </div>
                        <?php } ?> 
                        <?php if($row['usertype']=='student'){ ?>
                        <div class="profile-info">
                            <label>Year:</label>
                            <b><?=$row['year'] ?></b>
                        </div>
                        <?php }elseif($row['usertype']=='personnel'){ ?>
                            <div class="profile-info">
                            <label>Address:</label>
                            <b><?=$row['address'] ?></b>
                        </div>
                        <?php } ?> 
                        <?php if($row['usertype']=='student'){ ?>
                        <div class="profile-info">
                            <label>Email:</label>
                            <b><?=$row['email'] ?></b>
                        </div>
                        <?php } ?> 
                        <?php if($row['usertype']=='student'){ ?>
                        <div class="profile-info">
                            <label>Address:</label>
                            <b><?=ucfirst($row['address'])." City" ?></b>
                        </div>
                        <?php }elseif($row['usertype']=='personnel'){ ?>
                            <div class="profile-info">
                            <label>Gender:</label>
                            <b><?=ucfirst($row['gender']) ?></b>
                        </div>
                        <?php } ?> 
                        <?php if($row['usertype']=='student'){ ?>
                        <div class="profile-info">
                            <label>Sex:</label>
                            <b><?=ucfirst($row['gender']) ?></b>
                        </div>
                        <?php }elseif($row['usertype']=='personnel'){ ?>
                            <div class="profile-info">
                            <label>Phone number:</label>
                            <b><?="0".$row['phonenumber'] ?></b>
                        </div>
                        <?php } ?>                        
                        <?php if($row['usertype']=='student'){ ?>
                        <div class="profile-info">
                            <label>Phone number:</label>
                            <b><?="0".$row['phonenumber'] ?></b>
                        </div>
                        <?php } ?>             
                    </div>
                    
                </div>                               
                
            </div>                           
            
        </div>
        
    </div>    
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"></script>
<script src="../../js/userhomepage.js"></script>
</html>
