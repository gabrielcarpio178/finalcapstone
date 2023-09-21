<?php 
require('Dbconnection.php');
session_start();
if(isset($_POST['order_num'])){
    $order_num = $_POST['order_num'];
    $teller_id = $_SESSION['id'];

    try {
        $sql = mysqli_query($connect, "SELECT order_tb.orderproduct_name, order_tb.order_productcategory, order_tb.order_amount, order_tb.order_quantity, order_tb.statues, order_tb.deadline_time, order_tb.order_num, user_tb.firstname, user_tb.lastname, user_tb.usertype FROM order_tb INNER JOIN user_tb ON order_tb.user_id = user_tb.user_id WHERE order_tb.order_num = '$order_num' 
        AND order_tb.teller_id = '$teller_id' ORDER BY order_tb.order_time DESC;");
        $row = mysqli_fetch_assoc($sql);
        // print_r($row);
    } catch (\Throwable $th) {
        echo $th;
    }

}

?>

<div class="d-flex flex-row justify-content-between">
    <div class="name_buyer"><?=$row['firstname']." ".$row['lastname'] ?></div>
    <?php if($row['statues']=='ACCEPTED'){ ?>
        <div class="d-flex flex-row"><div>Reference Number: </div><div class="order_number"><?=$row['order_num'] ?></div></div>
    <?php } ?>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Product</th>
            <th scope="col" id="DC">Amount</th>
            <th scope="col">Quantity</th>
        </tr>
    </thead>

    <?php $total_amount = 0; $total_qty = 0; do{  ?>

        <tr>
            <td>
                <b><?=$row['orderproduct_name'] ?></b>
                <center><div><?=$row['order_productcategory'] ?></div></center>    
            </td>
            <td><?=$row['order_amount'] ?></td>
            <td><?=$row['order_quantity'] ?></td>
        </tr>

    <?php $total_amount = $row['order_amount'] + $total_amount;
          $total_qty = $row['order_quantity'] + $total_qty;
        }while($row = mysqli_fetch_array($sql));  ?>
    <tr>
        <td>
            <b>Total: </b>
        </td>
        <td><?=$total_amount ?></td>
        <td><?=$total_qty ?></td>
    </tr>

</table>



