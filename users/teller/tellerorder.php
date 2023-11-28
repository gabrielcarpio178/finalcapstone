<?php
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="teller")){
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: ../../index.php');
        exit;
    }
}

$teller_id = $_SESSION['id'];

try {
    $sql = mysqli_query($connect, "SELECT order_tb.order_time, order_tb.teller_id, order_tb.statues, SUM(order_tb.order_amount) AS total_amount, user_tb.firstname, user_tb.lastname, student_tb.course, personnel_tb.department, order_tb.order_num FROM order_tb INNER JOIN user_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON student_tb.user_id = user_tb.user_id LEFT JOIN personnel_tb ON personnel_tb.user_id = user_tb.user_id WHERE order_tb.teller_id = '$teller_id' AND order_tb.statues IS NULL GROUP BY order_tb.order_num ORDER BY order_tb.order_time DESC;");

    $row = mysqli_fetch_assoc($sql);
    $num_row = mysqli_num_rows($sql);

    if(!empty($row)){
        $order_num = $row['order_num'];
        $order_date = $row['order_time'];
    }

} catch (\Throwable $th) {
    echo $th;
}

try {
    $sql_accepted = mysqli_query($connect, "SELECT order_tb.order_time, order_tb.teller_id, order_tb.statues, SUM(order_tb.order_amount) AS total_amount, user_tb.firstname, user_tb.lastname, student_tb.course, personnel_tb.department, order_tb.order_num FROM order_tb INNER JOIN user_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON student_tb.user_id = user_tb.user_id LEFT JOIN personnel_tb ON personnel_tb.user_id = user_tb.user_id WHERE order_tb.teller_id = '$teller_id' AND order_tb.statues = 'ACCEPTED' GROUP BY order_tb.order_num ORDER BY order_tb.order_time DESC;");
    $row_accepted = mysqli_num_rows($sql_accepted);
} catch (\Throwable $th) {
    echo $th;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/fontawesome.css">
<link rel="stylesheet" href="../../fontawesome-free-6.4.2-web/css/all.css">
<link rel="stylesheet" href="../../css/all.min.css">
<link rel="stylesheet" href="../../css/sweetalert2.min.css">
<link rel="stylesheet" href="../../css/bootstrap.min.css">   
<link rel="stylesheet" href="../../css/tellerorder.css">
    <title>order</title>
</head>
<body>
    <div id="nav"></div>   
    <div class="container-fluid">

        <div class="d-flex align-items-center flex-row">
            <b class="order-label">ORDER</b> 
        </div>  

        <div class="d-flex flex-row justify-content-start mt-3">
            <div class="d-flex flex-row justify-content-center fucos-info w-25 info-type" id="btnpending">
                <div id="pending-student">
                    PENDING
                </div>
                <div class="pending-number number"><?=$num_row ?></div>
            </div>

            <div class="d-flex flex-row justify-content-center w-25 info-type" id="btnaccept">
                <div id="approved-student">
                    APPROVED
                </div>
                <div class="approved-number number"><?=$row_accepted ?></div>
            </div>
            
        </div>

        <div class="d-flex flex-column info-table">
            
        <div class="d-flex flex-column mt-3"> 

            <?php if(!empty($row)){ ?> 
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col" id="DC">DEPARTMENT</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">ORDER TIME</th>
                    </tr>
                </thead>
            <?php do{ ?>

                <tr class="info" id="<?=$row['order_num'] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <td><?=$row['firstname']." ".$row['lastname'] ?></td>
                    <td>
                        <?php
                            if($row['course']!=NULL){
                                echo $row['course'];

                            }elseif($row['department']!=NULL){
                                echo $row['department'];
                            }
                        ?>
                    </td>
                    <td><?=$row['total_amount'].".00" ?></td>
                    <td><?=date_format(date_create($row['order_time']), "m:d:Y h:i") ?></td>
                </tr>

            <?php }while($row = mysqli_fetch_array($sql)); }else{ echo "<h1>Empty</h1>";
            } ?>
            </table>
        </div>
        
        
    </div>


    <!-- order summary -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Summary</h5>
                <button type="button" class="btn-close" id="close_modal_summary" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="table-order"></div>
                
            </div>

            <div class="d-flex flex-row justify-content-center modal-footer">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#insert_time">Accept</button>
                <button type="button" class="btn btn-danger" id="decline_order">Decline</button>
            </div>

            </div>
        </div>
    </div>


    <!-- input time -->
    <div class="modal fade" id="insert_time" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="submitdeadline">
                <div class="modal-body">

                    <input type="hidden" value="<?=$order_num ?>" class="order_num" id="order_num">
                    <input type="hidden" value="<?=$order_date ?>" id="order_date" class="order_date">
                    <div class="d-flex flex-row align-items-center">
                        <input type="number" class="form-control" id="inputedtime" name="inputedtime" placeholder="Insert Time"
                        />    
                        <div>MINS</div>
                    </div>
                    
                </div>

                <div class="d-flex flex-row justify-content-center modal-footer">
                    <input type="submit" value="submit" data-bs-dismiss="modal" class="btn btn-primary"> 
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- proceed -->
    <div class="modal fade" id="procced_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Summary</h5>
                <button type="button" class="btn-close" id="close_modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="procced_info"></div>
                
            </div>

            <div class="d-flex flex-row justify-content-center modal-footer">
                <button type="button" class="btn btn-success" id="proceed">Proceed</button>
                <button type="button" class="btn btn-danger" id="decline_reserve">Decline</button>
            </div>

            </div>
        </div>
    </div>


            
</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"></script> -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/tellerorder.js"></script>
<script src="../../js/moment.min.js"></script>
</html>
