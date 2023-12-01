<?php 
require('Dbconnection.php');
if(isset($_POST['user_id'])&&isset($_POST['time'])){  
    $teller_id = $_POST['teller_id'];  
    $time = $_POST['time'];
    $user_id = $_POST['user_id'];
    try{
        $sql = mysqli_query($connect, "SELECT `orderproduct_name`, `order_productcategory`, `order_time`, `deadline_time`, `order_amount`, `order_quantity`, `statues`, `order_num` FROM `order_tb` WHERE `user_id` = '$user_id' AND `order_time` = '$time' AND `teller_id` = '$teller_id';");
        $order_item = mysqli_fetch_assoc($sql);
        
    }catch(\Throwable $th){
        echo $th;
    }
}

?>

<div>Order Summary</div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Amount</th>
                <th scope="col">Quantity</th>
            </tr>
        </thead>
            
        <tbody>
            <?php $qty = 0;
            $total=0; do{ ?>
            
            <tr class="table-active">
                <td>
                    <div class="d-flex flex-column product">
                        <div class="fw-bold"><?=$order_item['orderproduct_name'] ?></div>
                        <div><?=$order_item['order_productcategory'] ?></div>                                           
                    </div>
                </td>
                    <td class="amount"><?=$order_item['order_amount'] ?></td>
                    <td class="quantity"><?php echo ($order_item['order_quantity']!=NULL)?$order_item['order_quantity']: "PURCHASE"; ?></td>                                      
            </tr>

            <?php $total = $order_item['order_amount'] + $total;
            $qty = $order_item['order_quantity'] + $qty;
            $statues = $order_item['statues'];
            }while($order_item = mysqli_fetch_array($sql)); ?>
        </tbody>
            <tr>
                <td class="fw-bold">Total</td>
                <td class="amount"><?=$total ?></td>
                <td class="quantity"><?php echo ($qty!=0)?$qty:"PURCHASE"; ?></td>
            </tr>
            
    </table>
    
