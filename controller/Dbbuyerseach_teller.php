<?php

require('Dbconnection.php');
if(isset($_POST['search'])){
    $search = $_POST['search'];
    try {
        $sql = mysqli_query($connect, "SELECT `store_name`, `teller_qr` FROM `telleruser_tb` WHERE `store_name` LIKE '".$search."%';");
    } catch (\Throwable $th) {
        echo $th;
    }
    $array = array();
    $store_name = array();
    $teller_qr = array();
    while($row = mysqli_fetch_assoc($sql)){
        $store_name[] = $row['store_name'];
        $teller_qr[] = $row['teller_qr'];
    }
    array_push($array, $store_name, $teller_qr);
    print_r(json_encode($array));
    // print_r($store_name);

}

?>