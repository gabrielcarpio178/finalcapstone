<?php
require('Dbconnection.php');
session_start();

$teller_id = $_SESSION['id'];

try {
    $sql = mysqli_query($connect, "SELECT order_tb.order_time, order_tb.teller_id, order_tb.statues, SUM(order_tb.order_amount) AS total_amount, user_tb.firstname, user_tb.lastname, student_tb.course, personnel_tb.department, order_tb.order_num FROM order_tb INNER JOIN user_tb ON order_tb.user_id = user_tb.user_id LEFT JOIN student_tb ON student_tb.user_id = user_tb.user_id LEFT JOIN personnel_tb ON personnel_tb.user_id = user_tb.user_id WHERE order_tb.teller_id = '$teller_id' AND order_tb.statues IS NULL GROUP BY order_tb.order_num ORDER BY order_tb.order_time DESC;");

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

    <?php }while($row = mysqli_fetch_array($sql)); }else{ echo "<h1>Empty</h1>"; } ?>
    </table>
</div>