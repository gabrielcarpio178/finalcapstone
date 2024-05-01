<?php
require('Dbconnection.php');
$table_type = $_GET['table'];
//user_table
if($table_type=='user_tb'){
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }

    $fileName = "user_table_" . date('Y-m-d') . ".xls"; 
    $fields = array('ID', 'FIRST NAME', 'LAST NAME', 'EMAIL', 'GENDER', 'ADDRESS', 'DEPARTMENT','USERNAME', 'PASSWORD'); 

    $excelData = implode("\t", array_values($fields)) . "\n"; 
    try {
        $sql = mysqli_query($connect, "SELECT user_tb.user_id ,user_tb.firstname, user_tb.lastname, user_tb.email, user_tb.phonenumber, user_tb.gender, user_tb.complete_address, user_tb.username, user_tb.password, student_tb.course, personnel_tb.department FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id;");
        $row_count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row_count > 0){ 
        while($row = mysqli_fetch_assoc($sql)){ 
            if($row['course']==NULL){
                $department = $row['department'];
            }else{
                $department = $row['course'];
            }
            $lineData = array($row['user_id'], $row['firstname'], $row['lastname'], $row['email'], $row['gender'], $row['complete_address'], $department ,$row['username'], $row['password']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n"; 
    }
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    echo $excelData; 

    exit;
}
//adminannoucement table
else if($table_type=='adminannoucement'){
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }

    $fileName = "adminannoucement_table" . date('Y-m-d') . ".xls"; 
    $fields = array('ID', 'POST', 'POST_DATE', 'POST_TYPE'); 

    $excelData = implode("\t", array_values($fields)) . "\n"; 
    try {
        $sql = mysqli_query($connect, "SELECT `announcement_id`, `post`, `post_date`, `post_type` FROM `adminannoucement`");
        $row_count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row_count > 0){ 
        while($row = mysqli_fetch_assoc($sql)){ 
            $lineData = array($row['announcement_id'], $row['post'], $row['post_date'], $row['post_type']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n"; 
    }
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    echo $excelData; 

    exit;
}
//cashierrates_tb
elseif($table_type=='cashierrates_tb'){
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }

    $fileName = "cashierrates_tb" . date('Y-m-d') . ".xls"; 
    $fields = array('ID', 'PAYMENT', 'AMOUNT'); 

    $excelData = implode("\t", array_values($fields)) . "\n"; 
    try {
        $sql = mysqli_query($connect, "SELECT * FROM `cashierrates_tb`");
        $row_count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row_count > 0){ 
        while($row = mysqli_fetch_assoc($sql)){ 
            $lineData = array($row['cashierRates_id'], $row['cashierRatesCertificate'], $row['cashierRates_amount']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n"; 
    }
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    echo $excelData; 

    exit;
}
//cash in
elseif($table_type=='cashin_tb'){
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }

    $fileName = "cashin_table" . date('Y-m-d') . ".xls"; 
    $fields = array('ID', 'FIRST_NAME', 'LASTNAME', 'AMOUNT', 'REF NO.'); 

    $excelData = implode("\t", array_values($fields)) . "\n"; 
    try {
        $sql = mysqli_query($connect, "SELECT user_tb.user_id, cashin_tb.cashin_id, user_tb.firstname, user_tb.lastname, cashin_tb.ref_num, cashin_tb.cashin_amount FROM user_tb INNER JOIN cashin_tb ON user_tb.user_id = cashin_tb.user_id;");
        $row_count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row_count > 0){ 
        while($row = mysqli_fetch_assoc($sql)){ 
            $lineData = array($row['user_id'], $row['firstname'], $row['lastname'], $row['cashin_amount'], $row['ref_num']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n"; 
    }
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    echo $excelData; 

    exit;
}
//cash out
elseif($table_type=='cashout_tb'){

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }

    $fileName = "cashout_table" . date('Y-m-d') . ".xls"; 
    $fields = array('ID', 'STORE_NAME', 'AMOUNT', 'REF NO.'); 

    $excelData = implode("\t", array_values($fields)) . "\n"; 
    try {
        $sql = mysqli_query($connect, "SELECT cashout_tb.cashout_id, telleruser_tb.store_name, cashout_tb.cashout_amount, cashout_tb.cashout_refnum, cashout_tb.cashout_date FROM cashout_tb INNER JOIN telleruser_tb ON cashout_tb.teller_id = telleruser_tb.teller_id;");
        $row_count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row_count > 0){ 
        while($row = mysqli_fetch_assoc($sql)){ 
            $lineData = array($row['cashout_id'], $row['store_name'], $row['cashout_amount'], $row['cashout_refnum']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n"; 
    }
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    echo $excelData; 

    exit;

}
//digitalpayment_tb
elseif($table_type=='digitalpayment_tb'){

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }

    $fileName = "digitalpayment_table" . date('Y-m-d') . ".xls"; 
    $fields = array('ID', 'FIRSTNAME', 'LASTNAME', 'SEMESTER', 'PAYMENT TYPE', 'AMOUNT', 'REF NO.', 'PAYMENT DATE'); 

    $excelData = implode("\t", array_values($fields)) . "\n"; 
    try {
        $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, digitalpayment_tb.digitalPayment_id, digitalpayment_tb.payment_amount, digitalpayment_tb.payment_type, digitalpayment_tb.payment_ref, digitalpayment_tb.semester_year, digitalpayment_tb.payment_date FROM digitalpayment_tb INNER JOIN user_tb ON digitalpayment_tb.user_id = user_tb.user_id;");
        $row_count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row_count > 0){ 
        while($row = mysqli_fetch_assoc($sql)){ 
            $lineData = array($row['digitalPayment_id'], $row['firstname'], $row['lastname'], $row['semester_year'], $row['payment_type'], $row['payment_amount'], $row['payment_ref'], $row['payment_date']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n"; 
    }
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    echo $excelData; 

    exit;

}
//order_tb
elseif($table_type=='order_tb'){

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }

    $fileName = "order_table" . date('Y-m-d') . ".xls"; 
    $fields = array('ID', 'FIRSTNAME', 'LASTNAME', 'PRODUCT NAME', 'AMOUNT', 'QUANTITY', 'REF NO.', 'ORDER DATE'); 

    $excelData = implode("\t", array_values($fields)) . "\n"; 
    try {
        $sql = mysqli_query($connect, "SELECT order_tb.order_id, order_tb.orderproduct_name, order_tb.order_num, order_tb.orderproduct_name, order_tb.order_time, order_tb.order_amount, order_tb.order_quantity, user_tb.firstname, user_tb.lastname FROM order_tb INNER JOIN user_tb ON order_tb.user_id = user_tb.user_id;");
        $row_count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row_count > 0){ 
        while($row = mysqli_fetch_assoc($sql)){ 
            $lineData = array($row['order_id'], $row['firstname'], $row['lastname'], $row['orderproduct_name'], $row['order_amount'], $row['order_quantity'], $row['order_num'], $row['order_time']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n"; 
    }
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    echo $excelData; 

    exit;

}
//product_tb
elseif($table_type=='product_tb'){

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }

    $fileName = "product_table" . date('Y-m-d') . ".xls"; 
    $fields = array('ID', 'STORE NAME', 'PRODUCT NAME', 'CATEGORY NAME', 'PRICE', 'QUANTITY'); 

    $excelData = implode("\t", array_values($fields)) . "\n"; 
    try {
        $sql = mysqli_query($connect, "SELECT product_tb.product_id, product_tb.product_name, product_tb.price, product_tb.quantity, telleruser_tb.store_name, category_tb.category_name FROM product_tb INNER JOIN telleruser_tb ON product_tb.teller_id = telleruser_tb.teller_id INNER JOIN category_tb ON product_tb.category_id = category_tb.category_id;");
        $row_count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row_count > 0){ 
        while($row = mysqli_fetch_assoc($sql)){ 
            $lineData = array($row['product_id'], $row['store_name'], $row['product_name'], $row['category_name'], $row['price'], $row['quantity']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n"; 
    }
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    echo $excelData; 

    exit;

}
//semesteryear_tb
elseif($table_type=='semesteryear_tb'){

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }

    $fileName = "product_table" . date('Y-m-d') . ".xls"; 
    $fields = array('ID', 'SEMESTER', 'SEMESTER START', 'SEMESTER END'); 

    $excelData = implode("\t", array_values($fields)) . "\n"; 
    try {
        $sql = mysqli_query($connect, "SELECT `semesterYear_id`, `semester`, `semester_start`, `semester_end` FROM `semesteryear_tb`;");
        $row_count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row_count > 0){ 
        while($row = mysqli_fetch_assoc($sql)){ 
            $lineData = array($row['semesterYear_id'], $row['semester'], $row['semester_start'], $row['semester_end']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n"; 
    }
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    echo $excelData; 

    exit;

}
//sendbalance_tb
elseif($table_type=='sendbalance_tb'){

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }

    $fileName = "Transfer_Fund" . date('Y-m-d') . ".xls"; 
    $fields = array('ID', 'SENDER NAME', 'RECEIVER NAME', 'AMOUNT', 'REF NO.','DATE SEND'); 

    $excelData = implode("\t", array_values($fields)) . "\n"; 
    try {
        $sql = mysqli_query($connect, "SELECT sendbalance_tb.sendBalance_id, user_tb.firstname, user_tb.lastname, sendbalance_tb.send_amount, sendbalance_tb.sendBalance_ref, sendbalance_tb.receiver_id, sendbalance_tb.sendBalance_Date FROM sendbalance_tb INNER JOIN user_tb ON sendbalance_tb.sender_id = user_tb.user_id;");
        $row_count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row_count > 0){ 
        while($row = mysqli_fetch_assoc($sql)){ 
            try {
                $get_receiver_sql = mysqli_query($connect, "SELECT firstname, lastname FROM user_tb WHERE user_id = '".$row['receiver_id']."'");
                $get_receiver = mysqli_fetch_assoc($get_receiver_sql);
            } catch (\Throwable $th) {
                echo $th;
            }
            $lineData = array($row['sendBalance_id'], $row['firstname']." ".$row['lastname'], $get_receiver['firstname']." ".$get_receiver['lastname'], $row['send_amount'], $row['sendBalance_ref'], $row['sendBalance_Date']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n"; 
    }
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    echo $excelData; 

    exit;

}
//canteen staff
elseif($table_type=='telleruser_tb'){

    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    }

    $fileName = "canteen_staff_table" . date('Y-m-d') . ".xls"; 
    $fields = array('ID', 'FIRSTNAME', 'LASTNAME', 'STORE NAME', 'PHONE NUMBER', 'USERNAME', 'PASSWORD'); 

    $excelData = implode("\t", array_values($fields)) . "\n"; 
    try {
        $sql = mysqli_query($connect, "SELECT `teller_id`, `firstname_teller`, `lastname_teller`, `store_name`, `phonenumber_teller`, `username`, `password` FROM `telleruser_tb`");
        $row_count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($row_count > 0){ 
        while($row = mysqli_fetch_assoc($sql)){ 
            $lineData = array($row['teller_id'], $row['firstname_teller'], $row['lastname_teller'], $row['phonenumber_teller'], $row['username'], $row['password']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
    }else{
        $excelData .= 'No records found...'. "\n"; 
    }
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    echo $excelData; 

    exit;

}
?>