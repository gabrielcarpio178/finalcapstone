<?php
require('Dbconnection.php');
if(isset($_POST['sortBy'])&&isset($_POST['category'])&&isset($_POST['num_page'])){
    $sortBy = $_POST['sortBy'];
    $category = $_POST['category'];
    $num_page = $_POST['num_page'];
    if($num_page==0){
        $offset = 0;
    }else{
        $offset = ($num_page-1)*3;
    }
    $sortBy_type = '';
    if($sortBy=='all'){
        $sortBy_type = '';
    }else{
        $sortBy_type = " AND digitalpayment_tb.payment_type = '$sortBy'";
    }
    
    if($category=='Non Bago Fee'){
        try {
            $non_bago_sql = mysqli_query($connect, "SELECT digitalpayment_tb.payment_amount, digitalpayment_tb.payment_ref, CAST(digitalpayment_tb.payment_date AS DATE) AS paymentDate, user_tb.firstname, user_tb.lastname, student_tb.studentID_number FROM digitalpayment_tb INNER JOIN user_tb ON digitalPayment_tb.user_id = user_tb.user_id INNER JOIN student_tb ON digitalPayment_tb.user_id = student_tb.user_id WHERE digitalpayment_tb.payment_type = 'Non Bago Fee' AND CAST(digitalpayment_tb.payment_date AS DATE) = CAST(now() AS DATE) AND digitalpayment_tb.`requestType` = 'accepted' LIMIT $offset,3;");
            $array_non_bago = array();
            $empty = 1;
            while($non_bago_row = mysqli_fetch_assoc($non_bago_sql)){
                $empty = 0;
                $array_non_bago[] = array("payment_amount"=>$non_bago_row['payment_amount'],"payment_ref"=>$non_bago_row['payment_ref'], "paymentDate"=>$non_bago_row['paymentDate'], "name"=>$non_bago_row['firstname']." ".$non_bago_row['lastname'], "student_id"=>$non_bago_row['studentID_number']);
            }
            if($empty!=0){
                echo "No Record";
            }else{
                try {
                    $num_nonBago_row = mysqli_query($connect, "SELECT digitalpayment_tb.payment_amount, digitalpayment_tb.payment_ref, CAST(digitalpayment_tb.payment_date AS DATE) AS paymentDate, user_tb.firstname, user_tb.lastname, student_tb.studentID_number FROM digitalpayment_tb INNER JOIN user_tb ON digitalPayment_tb.user_id = user_tb.user_id INNER JOIN student_tb ON digitalPayment_tb.user_id = student_tb.user_id WHERE digitalpayment_tb.payment_type = 'Non Bago Fee' AND CAST(digitalpayment_tb.payment_date AS DATE) = CAST(now() AS DATE) AND digitalpayment_tb.`requestType` = 'accepted';");
                    $countRow_non_bago = ceil(mysqli_num_rows($num_nonBago_row)/3); 
                } catch (\Throwable $th) {
                    echo $th;
                }
                ?>
                    <table class="table table-hover text-center">
                        <thead id="table_head">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Reference #</th>
                                <th scope="col">Name</th>
                                <th scope="col">Student ID</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <?php
                                for($i = 0; $i<count($array_non_bago); $i++){
                                    ?>
                                        <tr>
                                            <td><?=date("m-d-Y", strtotime($array_non_bago[$i]['paymentDate'])) ?></td>
                                            <td><?=$array_non_bago[$i]['payment_ref'] ?></td>
                                            <td><?=$array_non_bago[$i]['name'] ?></td>
                                            <td><?=$array_non_bago[$i]['student_id'] ?></td>
                                            <td><?=$array_non_bago[$i]['payment_amount'].".00" ?></td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <ul class="pagination pagination-sm">
                        <li class="page-item" >
                            <a class="page-link" href="javascript:void(0)" <?php if($num_page == 0){ echo "disabled"; }else{ ?> onclick = "page(<?=$num_page-1 ?>);" <?php } ?>>&laquo;</a>
                        </li>
                        <?php
                        for($x = 1; $x<=$countRow_non_bago; $x++){
                            ?>
                            <li class="page-item <?=($x==$num_page)? "active": "" ?>">
                                <a class="page-link" href="javascript:void(0)" onclick = "page(<?=$x ?>);">
                                    <?=$x ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)"
                            <?php if($countRow_non_bago == $num_page){ echo "disabled"; }else{ ?> onclick = "page(<?=$num_page+1 ?>);" <?php } ?>>&raquo;</a>
                        </li>
                    </ul>
                <?php
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    elseif($category=='cash_out'){
        try {
            $cash_out_sql = mysqli_query($connect, "SELECT CAST(cashout_tb.cashout_date AS DATE) AS cashOutDate, CAST(cashout_tb.cashout_date AS TIME) AS cashOutTime, cashout_tb.cashout_amount, telleruser_tb.store_name, cashout_tb.cashout_refnum FROM cashout_tb INNER JOIN telleruser_tb ON cashout_tb.teller_id = telleruser_tb.teller_id WHERE cashout_tb.cashout_status = 'accepted' AND CAST(cashout_tb.cashout_date AS DATE) = CAST(now() AS DATE) LIMIT $offset,3;");
            $array_cash_out = array();
            $empty = 1;
            while($cashout_row = mysqli_fetch_assoc($cash_out_sql)){
                $empty = 0;
                $array_cash_out[] = array("cashOutDate"=>$cashout_row['cashOutDate'],"cashOutTime"=>$cashout_row['cashOutTime'], "cashout_amount"=>$cashout_row['cashout_amount'], "store_name"=>$cashout_row['store_name'], "cashout_refnum"=>$cashout_row['cashout_refnum']);
            }
            if($empty!=0){
                echo "No Record";
            }else{
                try {
                    $cashout_num_row = mysqli_query($connect, "SELECT CAST(cashout_tb.cashout_date AS DATE) AS cashOutDate, CAST(cashout_tb.cashout_date AS TIME) AS cashOutTime, cashout_tb.cashout_amount, telleruser_tb.store_name, cashout_tb.cashout_refnum FROM cashout_tb INNER JOIN telleruser_tb ON cashout_tb.teller_id = telleruser_tb.teller_id WHERE cashout_tb.cashout_status = 'accepted' AND CAST(cashout_tb.cashout_date AS DATE) = CAST(now() AS DATE);");
                    $countRow_cashOut = ceil(mysqli_num_rows($cashout_num_row)/3); 
                } catch (\Throwable $th) {
                    echo $th;
                }
                ?>
                    <table class="table table-hover text-center">
                        <thead id="table_head">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Name</th>
                            <th scope="col">Reference #</th>
                            <th scope="col">Amount</th>
                        </tr>
                        </thead>
                        <tbody id="table_body">
                            <?php
                                for($i = 0; $i<count($array_cash_out); $i++){
                                    ?>
                                        <tr>
                                            <td><?=date("m-d-Y", strtotime($array_cash_out[$i]['cashOutDate'])) ?></td>
                                            <td><?=date("h:i a", strtotime($array_cash_out[$i]['cashOutTime'])) ?></td>
                                            <td><?=$array_cash_out[$i]['store_name'] ?></td>
                                            <td><?=$array_cash_out[$i]['cashout_refnum'] ?></td>
                                            <td><?=$array_cash_out[$i]['cashout_amount'].".00" ?></td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <ul class="pagination pagination-sm">
                        <li class="page-item" >
                            <a class="page-link" href="javascript:void(0)" <?php if($num_page == 0){ echo "disabled"; }else{ ?> onclick = "page(<?=$num_page-1 ?>);" <?php } ?>>&laquo;</a>
                        </li>
                        <?php
                        for($x = 1; $x<=$countRow_cashOut; $x++){
                            ?>
                            <li class="page-item <?=($x==$num_page)? "active": "" ?>">
                                <a class="page-link" href="javascript:void(0)" onclick = "page(<?=$x ?>);">
                                    <?=$x ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)"
                            <?php if($countRow_cashOut == $num_page){ echo "disabled"; }else{ ?> onclick = "page(<?=$num_page+1 ?>);" <?php } ?>>&raquo;</a>
                        </li>
                    </ul>
                <?php
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($category=='cash_in'){
        try {
            $cash_in_sql = mysqli_query($connect, "SELECT CAST(cashin_tb.cashin_date AS DATE) AS cashInDate, user_tb.firstname, user_tb.lastname, student_tb.studentID_number, cashin_tb.ref_num, cashin_tb.cashin_amount FROM cashin_tb INNER JOIN user_tb ON cashin_tb.user_id = user_tb.user_id INNER JOIN student_tb ON cashin_tb.user_id = student_tb.user_id WHERE CAST(cashin_tb.cashin_date AS DATE) = CAST(now() AS DATE) LIMIT $offset,3;");
            $array_cash_in = array();
            $empty = 1;
            while($cashIn_row = mysqli_fetch_assoc($cash_in_sql)){
                $empty = 0;
                $array_cash_in[] = array("cashInDate"=>$cashIn_row['cashInDate'],"name"=>$cashIn_row['firstname']." ".$cashIn_row['lastname'], "studentID_number"=>$cashIn_row['studentID_number'], "ref_num"=>$cashIn_row['ref_num'], "cashin_amount"=>$cashIn_row['cashin_amount']);
            }
            if($empty!=0){
                echo "No Record";
            }else{
                try {
                    $cashIn_num_row = mysqli_query($connect, "SELECT CAST(cashin_tb.cashin_date AS DATE) AS cashInDate, user_tb.firstname, user_tb.lastname, student_tb.studentID_number, cashin_tb.ref_num, cashin_tb.cashin_amount FROM cashin_tb INNER JOIN user_tb ON cashin_tb.user_id = user_tb.user_id INNER JOIN student_tb ON cashin_tb.user_id = student_tb.user_id WHERE CAST(cashin_tb.cashin_date AS DATE) = CAST(now() AS DATE)");
                    $countRow_cashIn = ceil(mysqli_num_rows($cashIn_num_row)/3); 
                } catch (\Throwable $th) {
                    echo $th;
                }
                ?>
                    <table class="table table-hover text-center">
                        <thead id="table_head">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Name</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Reference #</th>
                            <th scope="col">Amount</th>
                        </tr>
                        </thead>
                        <tbody id="table_body">
                            <?php
                                for($i = 0; $i<count($array_cash_in); $i++){
                                    ?>
                                        <tr>
                                            <td><?=date("m-d-Y", strtotime($array_cash_in[$i]['cashInDate'])) ?></td>
                                            <td><?=$array_cash_in[$i]['name'] ?></td>
                                            <td><?=$array_cash_in[$i]['studentID_number'] ?></td>
                                            <td><?=$array_cash_in[$i]['ref_num'] ?></td>
                                            <td><?=$array_cash_in[$i]['cashin_amount'].".00" ?></td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <ul class="pagination pagination-sm">
                        <li class="page-item" >
                            <a class="page-link" href="javascript:void(0)" <?php if($num_page == 0){ echo "disabled"; }else{ ?> onclick = "page(<?=$num_page-1 ?>);" <?php } ?>>&laquo;</a>
                        </li>
                        <?php
                        for($x = 1; $x<=$countRow_cashIn; $x++){
                            ?>
                            <li class="page-item <?=($x==$num_page)? "active": "" ?>">
                                <a class="page-link" href="javascript:void(0)" onclick = "page(<?=$x ?>);">
                                    <?=$x ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)"
                            <?php if($countRow_cashIn == $num_page){ echo "disabled"; }else{ ?> onclick = "page(<?=$num_page+1 ?>);" <?php } ?>>&raquo;</a>
                        </li>
                    </ul>
                <?php
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($category=='tor'){
        try {
            $non_bago_sql = mysqli_query($connect, "SELECT digitalpayment_tb.payment_amount, digitalpayment_tb.payment_ref, CAST(digitalpayment_tb.payment_date AS DATE) AS paymentDate, user_tb.firstname, user_tb.lastname, student_tb.studentID_number FROM digitalpayment_tb INNER JOIN user_tb ON digitalPayment_tb.user_id = user_tb.user_id INNER JOIN student_tb ON digitalPayment_tb.user_id = student_tb.user_id WHERE digitalpayment_tb.payment_type = 'Transcript of Record' AND CAST(digitalpayment_tb.payment_date AS DATE) = CAST(now() AS DATE) AND digitalpayment_tb.`requestType` = 'accepted' LIMIT $offset,3;");
            $array_non_bago = array();
            $empty = 1;
            while($non_bago_row = mysqli_fetch_assoc($non_bago_sql)){
                $empty = 0;
                $array_non_bago[] = array("payment_amount"=>$non_bago_row['payment_amount'],"payment_ref"=>$non_bago_row['payment_ref'], "paymentDate"=>$non_bago_row['paymentDate'], "name"=>$non_bago_row['firstname']." ".$non_bago_row['lastname'], "student_id"=>$non_bago_row['studentID_number']);
            }
            if($empty!=0){
                echo "No Record";
            }else{
                try {
                    $num_nonBago_row = mysqli_query($connect, "SELECT digitalpayment_tb.payment_amount, digitalpayment_tb.payment_ref, CAST(digitalpayment_tb.payment_date AS DATE) AS paymentDate, user_tb.firstname, user_tb.lastname, student_tb.studentID_number FROM digitalpayment_tb INNER JOIN user_tb ON digitalPayment_tb.user_id = user_tb.user_id INNER JOIN student_tb ON digitalPayment_tb.user_id = student_tb.user_id WHERE digitalpayment_tb.payment_type = 'Transcript of Record' AND CAST(digitalpayment_tb.payment_date AS DATE) = CAST(now() AS DATE) AND digitalpayment_tb.`requestType` = 'accepted';");
                    $countRow_non_bago = ceil(mysqli_num_rows($num_nonBago_row)/3); 
                } catch (\Throwable $th) {
                    echo $th;
                }
                ?>
                    <table class="table table-hover text-center">
                        <thead id="table_head">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Reference #</th>
                                <th scope="col">Name</th>
                                <th scope="col">Student ID</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <?php
                                for($i = 0; $i<count($array_non_bago); $i++){
                                    ?>
                                        <tr>
                                            <td><?=date("m-d-Y", strtotime($array_non_bago[$i]['paymentDate'])) ?></td>
                                            <td><?=$array_non_bago[$i]['payment_ref'] ?></td>
                                            <td><?=$array_non_bago[$i]['name'] ?></td>
                                            <td><?=$array_non_bago[$i]['student_id'] ?></td>
                                            <td><?=$array_non_bago[$i]['payment_amount'].".00" ?></td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <ul class="pagination pagination-sm">
                        <li class="page-item" >
                            <a class="page-link" href="javascript:void(0)" <?php if($num_page == 0){ echo "disabled"; }else{ ?> onclick = "page(<?=$num_page-1 ?>);" <?php } ?>>&laquo;</a>
                        </li>
                        <?php
                        for($x = 1; $x<=$countRow_non_bago; $x++){
                            ?>
                            <li class="page-item <?=($x==$num_page)? "active": "" ?>">
                                <a class="page-link" href="javascript:void(0)" onclick = "page(<?=$x ?>);">
                                    <?=$x ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)"
                            <?php if($countRow_non_bago == $num_page){ echo "disabled"; }else{ ?> onclick = "page(<?=$num_page+1 ?>);" <?php } ?>>&raquo;</a>
                        </li>
                    </ul>
                <?php
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }elseif($category=='Certificate'){

        $query = "SELECT digitalpayment_tb.payment_amount, digitalpayment_tb.payment_ref, CAST(digitalpayment_tb.payment_date AS DATE) AS paymentDate, user_tb.firstname, user_tb.lastname, student_tb.studentID_number, digitalpayment_tb.payment_type FROM digitalpayment_tb INNER JOIN user_tb ON digitalPayment_tb.user_id = user_tb.user_id INNER JOIN student_tb ON digitalPayment_tb.user_id = student_tb.user_id WHERE digitalpayment_tb.payment_type != 'Transcript of Record' AND digitalpayment_tb.payment_type != 'Non Bago Fee' AND CAST(digitalpayment_tb.payment_date AS DATE) = CAST(now() AS DATE) AND digitalpayment_tb.`requestType` = 'accepted'".$sortBy_type. " LIMIT $offset,3;";

        $query_num = "SELECT digitalpayment_tb.payment_amount, digitalpayment_tb.payment_ref, CAST(digitalpayment_tb.payment_date AS DATE) AS paymentDate, user_tb.firstname, user_tb.lastname, student_tb.studentID_number FROM digitalpayment_tb INNER JOIN user_tb ON digitalPayment_tb.user_id = user_tb.user_id INNER JOIN student_tb ON digitalPayment_tb.user_id = student_tb.user_id WHERE digitalpayment_tb.payment_type != 'Transcript of Record' AND digitalpayment_tb.payment_type != 'Non Bago Fee' AND CAST(digitalpayment_tb.payment_date AS DATE) = CAST(now() AS DATE) AND digitalpayment_tb.`requestType` = 'accepted'".$sortBy_type.";";

        try {
            $non_bago_sql = mysqli_query($connect, $query);
            $array_non_bago = array();
            $empty = 1;
            while($non_bago_row = mysqli_fetch_assoc($non_bago_sql)){
                $empty = 0;
                $array_non_bago[] = array("payment_amount"=>$non_bago_row['payment_amount'],"payment_ref"=>$non_bago_row['payment_ref'], "paymentDate"=>$non_bago_row['paymentDate'], "name"=>$non_bago_row['firstname']." ".$non_bago_row['lastname'],"payment_type"=>$non_bago_row['payment_type'], "student_id"=>$non_bago_row['studentID_number']);
            }
            if($empty!=0){
                echo "No Record";
            }else{
                try {
                    $num_nonBago_row = mysqli_query($connect, $query_num);
                    $countRow_non_bago = ceil(mysqli_num_rows($num_nonBago_row)/3); 
                } catch (\Throwable $th) {
                    echo $th;
                }
                ?>
                    <table class="table table-hover text-center">
                        <thead id="table_head">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Reference #</th>
                                <th scope="col">Name</th>
                                <th scope="col">Certificate Type</th>
                                <th scope="col">Student ID</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <?php
                                for($i = 0; $i<count($array_non_bago); $i++){
                                    ?>
                                        <tr>
                                            <td><?=date("m-d-Y", strtotime($array_non_bago[$i]['paymentDate'])) ?></td>
                                            <td><?=$array_non_bago[$i]['payment_ref'] ?></td>
                                            <td><?=$array_non_bago[$i]['name'] ?></td>
                                            <td><?=$array_non_bago[$i]['payment_type'] ?></td>
                                            <td><?=$array_non_bago[$i]['student_id'] ?></td>
                                            <td><?=$array_non_bago[$i]['payment_amount'].".00" ?></td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <ul class="pagination pagination-sm">
                        <li class="page-item" >
                            <a class="page-link" href="javascript:void(0)" <?php if($num_page == 0){ echo "disabled"; }else{ ?> onclick = "page(<?=$num_page-1 ?>);" <?php } ?>>&laquo;</a>
                        </li>
                        <?php
                        for($x = 1; $x<=$countRow_non_bago; $x++){
                            ?>
                            <li class="page-item <?=($x==$num_page)? "active": "" ?>">
                                <a class="page-link" href="javascript:void(0)" onclick = "page(<?=$x ?>);">
                                    <?=$x ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)"
                            <?php if($countRow_non_bago == $num_page){ echo "disabled"; }else{ ?> onclick = "page(<?=$num_page+1 ?>);" <?php } ?>>&raquo;</a>
                        </li>
                    </ul>
                <?php
            }
        } catch (\Throwable $th) {
            echo $th;
        }

    }
}
?>