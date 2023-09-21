<?php
require('Dbconnection.php');
session_start();
date_default_timezone_set("Asia/Manila"); 
$teller_id = $_SESSION['id'];

try {
    $sql = mysqli_query($connect, "SELECT order_tb.order_time, order_tb.deadline_time, CAST(order_tb.deadline_time AS TIME) AS deadline, order_tb.teller_id, order_tb.statues, SUM(order_tb.order_amount) AS total_amount, user_tb.firstname, user_tb.lastname, student_tb.course, personnel_tb.department, order_tb.order_num FROM order_tb INNER JOIN user_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON student_tb.user_id = user_tb.user_id LEFT JOIN personnel_tb ON personnel_tb.user_id = user_tb.user_id WHERE order_tb.teller_id = '$teller_id' AND order_tb.statues = 'ACCEPTED' GROUP BY order_tb.order_num ORDER BY order_tb.order_time DESC;");

    $row = mysqli_fetch_assoc($sql);
    if(!empty($row)){
        $order_num = $row['order_num'];
        $order_date = $row['order_time'];
    }
} catch (\Throwable $th) {
    echo $th;
}

?>

<div class="d-flex flex-column mt-3"> 

    <?php if(!empty($row)){ ?> 
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">NAME</th>
                <th scope="col" id="DC">DEPARTMENT</th>
                <th scope="col">AMOUNT</th>
                <th scope="col">TIME</th>
            </tr>
        </thead>
    <?php 

    $current_date = new Datetime();
    $strcurrent_date = $current_date->format('Y-m-d H:i:s');
    
    do{

    $order_time = new Datetime($row['deadline_time']);
    $interval = $order_time->diff($current_date);

    
    if(round((strtotime($row['deadline'])-strtotime($strcurrent_date))/60)-1 >= 0){
        $order_deadline = (intval($interval->format("%i"))+1)." mins";
    }else{
        $order_deadline = "0 mins";
    }

        ?>

        <tr class="proceed" data-bs-toggle="modal" data-bs-target="#procced_modal" onclick="viewaccepted('<?=$row['order_num'] ?>');">
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
            <td><?=$order_deadline ?></td>
        </tr>

    <?php }while($row = mysqli_fetch_array($sql)); }else{ echo "<h1>Empty</h1>"; } ?>
    </table>
</div>