<?php
require('Dbconnection.php');
if(isset($_POST['teller_id'])&&isset($_POST['filter'])){
    $teller_id = $_POST['teller_id'];
    $filter = $_POST['filter'];
    if($filter == 'daily'){
        $can_sql = "CAST(order_tb.deadline_time AS DATE) LIKE CAST(now() AS DATE)";
    }elseif ($filter == 'weekly') {
        $can_sql = "WEEK(CAST(order_tb.deadline_time AS DATE),0) LIKE WEEK(CAST(now() AS DATE),0)";
    }elseif($filler='monthly'){
        $can_sql = "MONTH(order_tb.deadline_time) LIKE MONTH(now())";
    }
    elseif($filler='yearly'){
        $can_sql = "YEAR(CAST(order_tb.deadline_time AS DATE)) LIKE YEAR(CAST(now() AS DATE))";
    }
    
    try {
        $sql_expense = mysqli_query($connect, "SELECT category_id, category_name FROM category_tb WHERE teller_id='$teller_id';");
    } catch (\Throwable $th) {
        echo $th;
    }


    try {
        $sql_revenue = mysqli_query($connect, "SELECT IFNULL(SUM(order_tb.order_amount),0) AS total_amount, order_tb.order_productcategory, order_tb.deadline_time FROM order_tb WHERE order_tb.teller_id='$teller_id' AND statues='PROCEED' AND ".$can_sql." GROUP BY order_tb.order_productcategory;");
    } catch (\Throwable $th) {
        echo $th;
    }

    $array = array();
    $category = array();
    $revenue_category = array();
    $value_category = array();
    while($expense = mysqli_fetch_assoc($sql_expense)){
        $category[] = $expense['category_name'];
    }
    while($revenue = mysqli_fetch_assoc($sql_revenue)){
        $revenue_category[] = $revenue['order_productcategory'];
        $value_category[$revenue['order_productcategory']][] = $revenue['total_amount'];
    }
    array_push($array, $category, $value_category);
    print_r(json_encode($array));

    
}
?>