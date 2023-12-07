<?php 
session_start();
require('../../controller/Dbconnection.php');
if(!isset($_SESSION['id'])&&($_SESSION['usertype']!="student"||$_SESSION['usertype']!="personnel")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
    }
}else{
    $id = $_SESSION['id'];
    $firstname = $_SESSION['firstname'];
    try{
        $sql = mysqli_query($connect, "SELECT order_tb.user_id, order_tb.teller_id, order_tb.order_time, telleruser_tb.store_name, order_tb.statues, order_tb.order_num FROM order_tb INNER JOIN telleruser_tb ON order_tb.teller_id = telleruser_tb.teller_id WHERE `user_id` = '79' AND (order_tb.statues IS NULL OR order_tb.statues = 'ACCEPTED') AND (CAST(order_tb.order_time AS DATE) = CAST(NOW() AS DATE)) GROUP BY order_tb.order_num, order_tb.teller_id ORDER BY order_tb.order_id DESC;");
    }catch(\Throwable $th){
        echo $th;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, 
user-scalable=no">
    <title>Order Summary</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"> 
    <style>
    /**{
            outline: 1px solid;
        }*/        
        .profile-name{
            background-color: white;
            border-radius: 10px/10px;
            box-shadow: 0 1px 1px 1px #616161; 
            gap: 10px;
        }
        .profile-name img{
            border-radius: 50%;   
        }    
        .table-head{ 
            background-color: #aacaff82;
            border-bottom: 2px solid #93a3c4;                                 
        }         
        thead, tbody{
            text-align: center;
        }
        .table{
            border-spacing: 0 20px;
            border-collapse: separate;
        }
        .table-data{
            margin-top: 1em;
        }
        .table-order{
            background-color: white;
            box-shadow: 0 1px 1px 1px #616161; 
            display: none;
        }
        @media screen and (min-width: 320px) {
            body{
                font-size: 1em;
            }     
            .content-info{
                padding-top: 100px;
            }
            .myorder{
                margin-top: 30px;
                font-size: 1em;
            }
            .profile-name{
                max-height: 2em;
                padding: 2px;
            }
            .profile-name img{
                max-width: 1.5em;
                max-height: 1.5em;
            } 

            .profile-name .name{
                align-text: center;
            }

            .table-head{           
                padding: 8px;            
            }    
            .table-info{
                padding: 0px 15px 0px 15px;
            }
            .table-order{
                padding: 10px;
            }         
        }         
        @media screen and (min-width: 1020px) {
            body{
                font-size: 1.3em;
            }     
            .content-info{
                padding: 10px 10px 10px 100px;
            }
            .myorder{
                margin-top: 50px;
                font-size: 2em;
            }
            .profile-name{
                max-height: 2em;
                padding: 3px;
            }
            .profile-name img{
                max-width: 2em;
                max-height: 2em;
            } 
            .profile-name name{
                align-text: center;
            }  
            .table-head{           
                padding: 10px;    
                width: 50%;        
                margin-left: 25%;
            }                
            .table-info{
                padding: 0px 10px 0px 10px;
            }
            .table-order{
                padding: 20px;
                width: 50%;        
                margin-left: 25%;
            }
        }       
    </style>
</head>
<body>
    <div id="navbar"></div>  
    
    <div class="container-fluid">
        
        <div class="content-info">
            
            <div class="d-flex flex-column">
                
                <div class="d-flex flex-row justify-content-between">
                    <div class="fw-bold myorder">
                        ORDER
                    </div> 
                    <div class="d-flex flex-row justify-content-center profile-name">                        
                        <img src="<?php echo ($_SESSION['image']!=NULL)?"profile/".$_SESSION['image']:"../../image/avatar.jpg" ?>">
                        <div class="name"><?=$firstname ?></div>                        
                    </div>                                      
                </div>
                <?php
                    if(mysqli_num_rows($sql)==0){
                        echo "No Record";
                    }
                ?>
                <?php $i=1; while($sqlinfo=mysqli_fetch_array($sql)){ ?>
                <div class="table-data">
                    <div class="d-flex flex-row justify-content-between  mt-lg-5 table-head" onclick="table_info('<?=$sqlinfo['order_time']; ?>', '<?=$id; ?>', '<?=$i ?>', <?=$sqlinfo['teller_id'] ?>)" >
                    
                        <div><?=ucfirst($sqlinfo['store_name']) ?></div>
                        <div>Date: <?=date_format(date_create($sqlinfo['order_time']), "Y-m-d") ?></div>
                    
                </div>
                
                <div class="table-order_<?=$i ?> table-order">
                    <div class="content-table_<?=$i ?>">

                    </div>
                    <div class="table-info">
                    <center>
                        <button class="btn btn-primary" <?=($sqlinfo['statues']!='ACCEPTED')? 'disabled= "disabled" ':''?> onclick="receiverOrder('<?=$sqlinfo['order_num'] ?>', '<?=$i ?>', '<?=$sqlinfo['teller_id'] ?>')">Order Received</button>
                    </center>        
                    </div>
                </div>
                
                <?php $i++; } ?>
                
            </div>
            
        </div>
        
    </div>
</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function(){
        $("#navbar").load("usernav.php");  
    });
    
    let r;
    
    function table_info(time, user_id, i, teller_id){
        if(r==i){
            $(".table-order_"+r).slideUp("slow", function(){
                $(this).hide();
            });
            r = undefined;
        }else{
            $(".table-order_"+r).slideUp("slow", function(){
                $(this).hide();
            });
            $.ajax({
                url: '../../controller/Dbusershoworder.php',
                type: 'POST',
                data:{
                    teller_id : teller_id,              
                    time : time,
                    user_id : user_id 
                },
                cache: false,
                success: function(res){              
                    $(".content-table_"+i).html(res);                         
                }                
            });
            $(".table-order_"+i).slideDown("slow" , function(){
            $(this).show();
        }) 
            r = i;
        }      

    }
    function receiverOrder(order_num, i, teller_id){
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to receive this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, receive it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../controller/DbuserReceiver_order.php',
                    type: 'POST',
                    data: {
                        order_num : order_num,
                        teller_id : teller_id
                    },
                    cache: false,
                    success: function(res){
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Order Received",
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function(){
                            window.location = "userordersummary.php"
                        });
                    }
                });
            }
        });

    }
</script>

</html>
