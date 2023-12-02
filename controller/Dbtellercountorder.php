<?php
session_start();
require('Dbconnection.php');
if(isset($_POST['teller'])){
    $teller_id = $_SESSION['id'];
    $pedding = 0;
    $accepted = 0;
    try {
        $sql = mysqli_query($connect, "SELECT statues FROM order_tb WHERE (statues ='ACCEPTED' OR statues IS NULL) AND CAST(order_time AS DATE) = CAST(NOW() AS DATE) AND teller_id = '$teller_id' GROUP BY order_num;");
        while($row = mysqli_fetch_assoc($sql)){
            if($row['statues']=='ACCEPTED'){
                $accepted++;
            }else{
                $pedding++;
            }
        }
        print_r(json_encode(array("pending"=>$pedding, "accepted"=>$accepted)));
    } catch (\Throwable $th) {
        echo $th;
    }

}
?>