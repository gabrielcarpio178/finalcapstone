<?php
require('Dbconnection.php');
if(isset($_POST['info'])&&isset($_POST['department'])&&isset($_POST['date'])){
    $info = $_POST['info'];
    $department = $_POST['department'];
    $date = $_POST['date'];

    if($department=='all'&&$date==""){
        //cashin
        try {
            $sql_cashin = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, cashin_tb.cashin_amount, cashin_tb.ref_num, cashin_tb.cashin_date FROM cashin_tb INNER JOIN user_tb ON cashin_tb.user_id = user_tb.user_id LIMIT 20;");
            $array_cashin = array();
            while($cashin_row = mysqli_fetch_assoc($sql_cashin)){
                $array_cashin[] = array('type'=>'cashin', 'fullname'=>$cashin_row['firstname']." ".$cashin_row['lastname'], 'cashin_amount'=>$cashin_row['cashin_amount'],'ref_num'=>$cashin_row['ref_num'], 'date'=>$cashin_row['cashin_date']);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        //cashout
        try {
            $sql_cashout = mysqli_query($connect, "SELECT telleruser_tb.store_name, cashout_tb.cashout_date, cashout_tb.cashout_amount, cashout_tb.cashout_refnum FROM cashout_tb INNER JOIN telleruser_tb ON telleruser_tb.teller_id = cashout_tb.teller_id WHERE cashout_tb.cashout_status = 'accepted' LIMIT 20;");
            $array_cashout = array();
            while($cashout_row = mysqli_fetch_assoc($sql_cashout)){
                $array_cashout[] = array('type'=>'cashout', 'store_name'=>$cashout_row['store_name'], 'cashout_date'=>$cashout_row['cashout_date'],'cashout_amount'=>$cashout_row['cashout_amount'], 'date'=>$cashout_row['cashout_date'], 'cashout_refnum'=>$cashout_row['cashout_refnum']);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        //digital payment
        try {
            $sql_digitalPayment = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, digitalpayment_tb.payment_amount, digitalpayment_tb.payment_type, digitalpayment_tb.payment_ref, digitalpayment_tb.semester_year, digitalpayment_tb.payment_date FROM digitalpayment_tb INNER JOIN user_tb ON digitalpayment_tb.user_id = user_tb.user_id WHERE digitalpayment_tb.requestType='accepted' LIMIT 20;");
            $array_digitalPayment = array();
            while($digitalPayment_row = mysqli_fetch_assoc($sql_digitalPayment)){
                $array_digitalPayment[] = array('type'=>'digitalPayment', 'fullname'=>$digitalPayment_row['firstname']." ".$digitalPayment_row['lastname'], 'payment_amount'=>$digitalPayment_row['payment_amount'],'payment_type'=>$digitalPayment_row['payment_type'], 'payment_ref'=>$digitalPayment_row['payment_ref'], 'semester_year'=>$digitalPayment_row['semester_year'], 'date'=>$digitalPayment_row['payment_date']);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        $array_data = array_merge($array_cashin, $array_cashout, $array_digitalPayment);
        print_r(json_encode($array_data));

    }else{
        
        if($department=='cashin'){
            $cot_date = ($date!="")?" WHERE CAST(cashin_tb.cashin_date AS DATE) = '".$date."'":"";
            //cashin
            try {
                $sql_cashin = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, cashin_tb.cashin_amount, cashin_tb.ref_num, cashin_tb.cashin_date FROM cashin_tb INNER JOIN user_tb ON cashin_tb.user_id = user_tb.user_id".$cot_date);
                $array_cashin = array();
                while($cashin_row = mysqli_fetch_assoc($sql_cashin)){
                    $array_cashin[] = array('type'=>'cashin', 'fullname'=>$cashin_row['firstname']." ".$cashin_row['lastname'], 'cashin_amount'=>$cashin_row['cashin_amount'],'ref_num'=>$cashin_row['ref_num'], 'date'=>$cashin_row['cashin_date']);
                }
            } catch (\Throwable $th) {
                echo $th;
            }
            print_r(json_encode($array_cashin));

        }else if($department=='cashout'){

            $cot_date = ($date!="")?" AND CAST(cashout_tb.cashout_date AS DATE) = '".$date."'":"";
            //cashout
            try {
                $sql_cashout = mysqli_query($connect, "SELECT telleruser_tb.store_name, cashout_tb.cashout_date, cashout_tb.cashout_amount, cashout_tb.cashout_refnum FROM cashout_tb INNER JOIN telleruser_tb ON telleruser_tb.teller_id = cashout_tb.teller_id WHERE cashout_tb.cashout_status = 'accepted'".$cot_date);
                $array_cashout = array();
                while($cashout_row = mysqli_fetch_assoc($sql_cashout)){
                    $array_cashout[] = array('type'=>'cashout', 'store_name'=>$cashout_row['store_name'], 'cashout_date'=>$cashout_row['cashout_date'],'cashout_amount'=>$cashout_row['cashout_amount'], 'date'=>$cashout_row['cashout_date'], 'cashout_refnum'=>$cashout_row['cashout_refnum']);
                }
            } catch (\Throwable $th) {
                echo $th;
            }
            print_r(json_encode($array_cashout));
        }else if($department=='payment'){
            $cot_date = ($date!="")?" AND CAST(digitalpayment_tb.payment_date AS DATE) = '".$date."'":"";
            try {
                $sql_digitalPayment = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, digitalpayment_tb.payment_amount, digitalpayment_tb.payment_type, digitalpayment_tb.payment_ref, digitalpayment_tb.semester_year, digitalpayment_tb.payment_date FROM digitalpayment_tb INNER JOIN user_tb ON digitalpayment_tb.user_id = user_tb.user_id WHERE digitalpayment_tb.requestType='accepted'".$cot_date);
                $array_digitalPayment = array();
                while($digitalPayment_row = mysqli_fetch_assoc($sql_digitalPayment)){
                    $array_digitalPayment[] = array('type'=>'digitalPayment', 'fullname'=>$digitalPayment_row['firstname']." ".$digitalPayment_row['lastname'], 'payment_amount'=>$digitalPayment_row['payment_amount'],'payment_type'=>$digitalPayment_row['payment_type'], 'payment_ref'=>$digitalPayment_row['payment_ref'], 'semester_year'=>$digitalPayment_row['semester_year'], 'date'=>$digitalPayment_row['payment_date']);
                }
                print_r(json_encode($array_digitalPayment));
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        

    }
}
?>