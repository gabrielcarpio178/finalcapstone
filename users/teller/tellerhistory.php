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
$getorder = mysqli_query($connect, "SELECT order_tb.*, user_tb.usertype FROM order_tb JOIN user_tb ON order_tb.user_id = user_tb.user_id WHERE order_tb.teller_id = '$teller_id' AND order_tb.statues = 'PROCEED' GROUP BY order_tb.order_num;") or die(mysqli_error($connect));
$num_of_recond = mysqli_num_rows($getorder);
$num_per_page = 10;
$total_num_page =  ceil($num_of_recond/$num_per_page);
$page_num = 1;
$offset = ($page_num-1)*$total_num_page;
    try {
        $sql = mysqli_query($connect, "SELECT order_tb.order_time, SUM(order_tb.order_amount) AS total_amount, user_tb.firstname, user_tb.lastname, student_tb.course, order_tb.order_num, personnel_tb.department FROM user_tb INNER JOIN order_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON order_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id WHERE order_tb.teller_id = '$teller_id' AND order_tb.statues = 'PROCEED' GROUP BY order_tb.order_num ORDER BY order_tb.order_time DESC LIMIT $offset, $num_per_page;");
        $row = mysqli_fetch_assoc($sql);
    } catch (\Throwable $th) {
    echo $th;
    }
$name = $_SESSION['teller_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css">   
    <link rel="stylesheet" href="../../css/tellerhistory.css">
    <title>teller <?=$name; ?></title>
</head>
<body>
    <div id="nav"></div> 
    <div class="container-fluid">

        <div class="d-flex flex-column content-info">
            <div class="transaction-history fw-bold">TRANSACTION HISTORY</div>

            <div class="d-flex flex-row justify-content-between align-items-center">

                <div class="d-flex flex-column w-25">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="d-flex flex-column sort_by">
                    <label for="departmenr">Sort by department:</label>
                    <select name="department" id="department" class="department">
                        <option  selected>ALL</option>
                        <option value="SASO">SASO</option>
                        <option value="Faculty">Faculty</option>
                        <option value="Guidance">Guidance</option>
                        <option value="Registerar">Registerar</option>
                        <option value="Admin">Admin</option>
                        <option value="SSG">SSG</option>
                        <option value="BSCrim">BSCrim</option>
                        <option value="BSED">BSED</option>
                        <option value="BEED">BEED</option>
                        <option value="BSOA">BSOA</option>
                        <option value="BSIS">BSIS</option>
                    </select>
                </div>

                <div class="d-flex flex-column w-25">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                
                
            </div>

            <div class="loading fw-bold mt-2"></div>

            
            <div class="table-info mt-2">
                <?php if(!empty($row)){ ?>
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" id="DC">Department</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody class="table-body-load">

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
                                    <td><?=date_format(date_create($row['order_time']), "m/d/Y h:i A") ?></td>
                                </tr>
                            <?php }while($row = mysqli_fetch_array($sql)); ?>

                        </tbody>
                    </table>
                    <div>
                        <ul class="pagination">
                            <li class="page-item" >
                                <a class="page-link" href="javascript:void(0)" <?php if($page_num == 1){ echo "disabled"; }else{ ?> onclick = "prev('<?=$page_num-1 ?>');"<?php } ?>>&laquo;</a>
                            </li>
                            <?php for($i = 1; $i <= $total_num_page; $i++){ ?>
                                <li class="page-item <?=($i==$page_num)? "active": "" ?>">
                                    <a class="page-link" href="javascript:void(0)" onclick = "page_num('<?=$i ?>');"><?=$i ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)" <?php if($page_num==$total_num_page){ echo "disabled"; }else{ ?> onclick = "next('<?=$page_num+1 ?>');"<?php } ?>>&raquo;</a>
                            </li>
                        </ul>
                    </div>  

                    <?php }else{ echo "<h1>No Record</h1>";} ?>

            </div>
            

        </div>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-row justify-content-between">
                    <label for="name">Full Name: </label>
                    <p id="name"></p>
                </div>

                <div class="d-flex flex-row justify-content-between">
                    <label for="department_info">Department: </label>
                    <p id="department_info"></p>
                </div>
                
                <div class="d-flex flex-row justify-content-between student_class">
                    <label for="student_id">User type: </label>
                    <p id="student_id"></p>
                </div>

                <div class="d-flex flex-row justify-content-between">
                    <label for="payment_for">Payment for: </label>
                    <p id="payment_for">Purchase</p>  
                </div>

                <div class="d-flex flex-row justify-content-between">
                    <label for="date_time">Date & Time: </label>
                    <p id="date_time"></p>
                </div>
                           
                <div class="d-flex flex-row justify-content-between">
                    <label for="amount">Amount: </label>
                    <p id="amount"></p>
                </div>
                
                <div class="d-flex flex-row justify-content-between">
                    <label for="reference_num">Reference no. : </label>
                    <p id="reference_num"></p>
                </div>
                
                <center>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </center>
            </div>

            </div>
        </div>
    </div>
    
    

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
</html>
<script src="../../js/tellerhistory.js"></script>
<script>
    $("#nav").load("storenav.php");
    $("#order").addClass("active-class");
    
</script>