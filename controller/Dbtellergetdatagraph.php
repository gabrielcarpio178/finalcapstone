<?php
require('Dbconnection.php');
if(isset($_POST['teller_id'])&&isset($_POST['filter'])){
    $teller_id = $_POST['teller_id'];
    $filter = $_POST['filter'];
    if($filter=='daily'){
        $query = "SELECT SUM(`order_amount`) AS total_amount, `order_productcategory` FROM order_tb WHERE CAST(`order_time` AS DATE) = CAST(NOW() AS DATE) AND teller_id = '$teller_id' AND (statues = 'ACCEPTED' OR statues = 'PROCEED') GROUP BY `order_productcategory`;";
        try {
            $sql = mysqli_query($connect, $query);
            $result_array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $result_array[] = array('total_amount'=>$row['total_amount'], 'label'=>$row['order_productcategory']); 
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    else if($filter=='monthly'){
        $query = "SELECT SUM(`order_amount`) AS total_amount, MONTHNAME(`order_time`) AS monthly FROM order_tb WHERE teller_id = '$teller_id' AND (statues = 'ACCEPTED' OR statues = 'PROCEED') GROUP BY MONTH(`order_time`);";
        try {
            $sql = mysqli_query($connect, $query);
            $result_array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $result_array[] = array('total_amount'=>$row['total_amount'], 'label'=>$row['monthly']); 
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }else if($filter=='yearly'){
        $query = "SELECT SUM(`order_amount`) AS total_amount, year(`order_time`) AS year FROM order_tb WHERE teller_id = '$teller_id' AND (statues = 'ACCEPTED' OR statues = 'PROCEED') GROUP BY year(`order_time`);";
        try {
            $sql = mysqli_query($connect, $query);
            $result_array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $result_array[] = array('total_amount'=>$row['total_amount'], 'label'=>$row['year']); 
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    print_r(json_encode($result_array));
}
?>