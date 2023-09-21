<?php 
session_start();
require('Dbconnection.php');
if(!isset($_POST['name'])){
    $name = "";
}else{
    $name = " AND user_tb.firstname LIKE '".$_POST['name']."%' OR user_tb.lastname LIKE '".$_POST['name']."%' ";
}
if($_POST['department']=="ALL"){
    $department = "";
}else{
    $personnel = array("SASO", "Faculty", "Guidance", "Registerar", "Admin", "SSG");
    $student = array("BSCrim", "BSED", "BEED", "BSOA", "BSIS");
    $i = 0;
    $t = true;
    do{
        if($_POST['department']==$personnel[$i]){
            $department = " AND personnel_tb.department = '".$_POST['department']."' ";
            $t = false;
        }elseif($_POST['department']==$student[$i]){
            $department = " AND student_tb.course = '".$_POST['department']."' ";
            $t = false;
        }else{
            $t = true;
        }
        $i++;
    }while($t == true);  
    
}

if($_POST['date']==""){
    $date = "";
}else{
    $date = " AND order_tb.order_time LIKE '".$_POST['date']."%' ";
}

if(isset($_POST['page'])){
    $teller_id = $_SESSION['id'];
    $page_num = $_POST['page'];

    $getorder = mysqli_query($connect, "SELECT order_tb.order_time, SUM(order_tb.order_amount) AS total_amount, user_tb.firstname, user_tb.lastname, student_tb.course, personnel_tb.department FROM user_tb INNER JOIN order_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON order_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id WHERE order_tb.teller_id = '$teller_id' AND order_tb.statues = 'PROCEED'".$name.$department.$date." GROUP BY order_tb.order_num ORDER BY order_tb.order_time DESC;") or die(mysqli_error($connect));
    $num_of_recond = mysqli_num_rows($getorder);
    $num_per_page = 10;
    $total_num_page =  ceil($num_of_recond/$num_per_page);
    $offset = ($page_num-1)*$num_per_page;

    try {
    $sql = mysqli_query($connect, "SELECT order_tb.order_time, SUM(order_tb.order_amount) AS total_amount, user_tb.firstname, user_tb.lastname, student_tb.course, order_tb.order_num, personnel_tb.department FROM user_tb INNER JOIN order_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON order_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id WHERE order_tb.teller_id = '$teller_id' AND order_tb.statues = 'PROCEED'".$name.$department.$date." GROUP BY order_tb.order_num ORDER BY order_tb.order_time DESC LIMIT $offset, $num_per_page;");
    $row = mysqli_fetch_assoc($sql);
    if(!empty($row)){
    ?>
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
                        <td><?=date_format(date_create($row['order_time']), "m:d:Y h:i") ?></td>
                    </tr>
                <?php }while($row = mysqli_fetch_array($sql)); ?>

            </tbody>
        </table>
        <div>
            <ul class="pagination">
                <li class="page-item" >
                    <a class="page-link" href="javascript:void(0)" <?php if($page_num <= 1){ echo "disabled"; }else{ ?> onclick = "prev('<?=$page_num-1 ?>');"<?php } ?>>&laquo;</a>
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
    <?php
    }else{
        echo "<h1>No Record</h1>";
    }
    } catch (\Throwable $th) {
        echo $th;
    }

}

?>
