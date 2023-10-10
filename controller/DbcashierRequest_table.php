<?php
require('Dbconnection.php');

if(isset($_POST['content'])&&isset($_POST['num_page'])){
    $content = $_POST['content'];
    $num_page = $_POST['num_page'];
    if($num_page==0){
        $offset = 0;
    }else{
        $offset = ($num_page-1)*5;
    }

    if($content=='non_bago_table'){
        $array = array();
        $name = array();
        $studentID_number = array();
        $course = array();
        $year = array();
        $payment_amount = array();
        $payment_date = array();
        $digitalPayment_id = array();
        $payment_ref = array();
        try {
            $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, student_tb.studentID_number, student_tb.course, student_tb.year, digitalpayment_tb.payment_amount, digitalpayment_tb.payment_type, user_tb.user_id, CAST(digitalpayment_tb.payment_date AS DATE) AS payment_dates, digitalpayment_tb.digitalPayment_id, digitalpayment_tb.payment_ref FROM user_tb INNER JOIN digitalpayment_tb ON user_tb.user_id = digitalpayment_tb.user_id INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id WHERE digitalpayment_tb.payment_type = 'Non Bago Fee' AND requestType = 'pending' ORDER BY digitalPayment_id DESC LIMIT $offset,  5;");
            while($row = mysqli_fetch_assoc($sql)){
                $name[] = $row['firstname']." ".$row['lastname'];
                $studentID_number[] = $row['studentID_number'];
                $course[] = $row['course'];
                $year[] = $row['year'];
                $payment_amount[] = $row['payment_amount'];
                $payment_date[] = date("m-d-Y", strtotime($row['payment_dates']));
                $digitalPayment_id[] = $row['digitalPayment_id'];
                $payment_ref[] = $row['payment_ref'];
            }
        } catch (\Throwable $th) {
            echo $th;
        }

        try {
            $num_sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, student_tb.studentID_number, student_tb.course, student_tb.year, digitalpayment_tb.payment_amount, digitalpayment_tb.payment_type, digitalpayment_tb.payment_date, digitalpayment_tb.digitalPayment_id FROM user_tb INNER JOIN digitalpayment_tb ON user_tb.user_id = digitalpayment_tb.user_id INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id WHERE digitalpayment_tb.payment_type = 'Non Bago Fee' AND requestType = 'pending';");
            $num_row = ceil(mysqli_num_rows($num_sql)/5);
        } catch (\Throwable $th) {
            echo $th;
        }
        array_push($array, $payment_date, $name, $studentID_number, $course, $year, $payment_amount, $digitalPayment_id, $payment_ref, $num_row);
        if(count($array[5])!=0){
            ?>
            <div class="table-div mt-3">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Reference #</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Course</th>
                            <th scope="col">Amount</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php
                    for($i = 0; $i<count($array[6]); $i++){
                        ?>
                        <tr id="<?=$array[6][$i] ?>">
                            <td><?=$array[0][$i] ?></td>
                            <td><?=$array[7][$i] ?></td>
                            <td><?=$array[2][$i] ?></td>
                            <td><?=$array[1][$i] ?></td>
                            <td><?=$array[3][$i] ?></td>
                            <td><?=$array[5][$i].".00" ?></td>
                            <td><button class="btn btn-primary" onclick="accept(<?=$array[6][$i] ?>, false)">Accept</button></td>
                            <td><button class="btn btn-danger" onclick="deletePayment(<?=$array[6][$i] ?>, false)">Cancel</button></td>
                        </tr>
                    <?php
                    }
                ?>                     
                    </tbody>
                </table>
            </div>
            <ul class="pagination">
                <li class="page-item" >
                    <a class="page-link" href="javascript:void(0)" <?php if($num_page == 0){ echo "disabled"; }else{ ?> onclick = "displayTable('non_bago_table', <?=$num_page-1 ?>);" <?php } ?>>&laquo;</a>
                </li>
                <?php
            for($x = 1; $x<=$array[8]; $x++){
                ?>
                <li class="page-item <?=($x==$num_page)? "active": "" ?>">
                    <a class="page-link" href="javascript:void(0)" onclick="displayTable('non_bago_table', <?=$x ?>);"><?=$x ?></a>
                </li>
                <?php
            }
                ?>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" <?php if($array[8] == $num_page){ echo "disabled"; }else{ ?> onclick = "displayTable('non_bago_table', <?=$num_page+1 ?>);" <?php } ?>>&raquo;</a>
                </li>
            </ul>
        <?php
        }else{
            echo "<h2><b>No Record..</b></h2>";
        }
    }elseif($content=='certificate'){
        $array = array();
        $name = array();
        $studentID_number = array();
        $year = array();
        $payment_amount = array();
        $payment_date = array();
        $digitalPayment_id = array();
        $payment_method = array();
        $payment_ref = array();
        try {
            $sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, student_tb.studentID_number, student_tb.year, user_tb.user_id, digitalpayment_tb.payment_amount, digitalpayment_tb.payment_type, CAST(digitalpayment_tb.payment_date AS DATE) AS payment_dates, digitalpayment_tb.digitalPayment_id, digitalpayment_tb.payment_ref FROM user_tb INNER JOIN digitalpayment_tb ON user_tb.user_id = digitalpayment_tb.user_id INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id WHERE digitalpayment_tb.payment_type != 'Non Bago Fee' AND requestType = 'pending' ORDER BY digitalPayment_id DESC LIMIT $offset,  5;");
            while($row = mysqli_fetch_assoc($sql)){
                $name[] = $row['firstname']." ".$row['lastname'];
                $studentID_number[] = $row['studentID_number'];
                $year[] = $row['year'];
                $payment_amount[] = $row['payment_amount'];
                $payment_date[] = date("m-d-Y", strtotime($row['payment_dates']));
                $digitalPayment_id[] = $row['digitalPayment_id'];
                $payment_method[] = $row['payment_type'];
                $payment_ref[] = $row['payment_ref'];
            }
        } catch (\Throwable $th) {
            echo $th;
        }

        try {
            $num_sql = mysqli_query($connect, "SELECT user_tb.firstname, user_tb.lastname, student_tb.studentID_number, student_tb.year, digitalpayment_tb.payment_amount, digitalpayment_tb.payment_type, digitalpayment_tb.payment_date, digitalpayment_tb.digitalPayment_id FROM user_tb INNER JOIN digitalpayment_tb ON user_tb.user_id = digitalpayment_tb.user_id INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id WHERE digitalpayment_tb.payment_type != 'Non Bago Fee'  AND requestType = 'pending';");
            $num_row = ceil(mysqli_num_rows($num_sql)/5);
        } catch (\Throwable $th) {
            echo $th;
        }
        array_push($array, $payment_date, $name, $studentID_number, $payment_method, $year, $payment_amount, $digitalPayment_id, $payment_ref, $num_row);
        if(count($array[5])!=0){
        ?>
            <div class="table-div mt-3">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Reference #</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type of Certificate</th>
                            <th scope="col">Amount</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php
                    for($i = 0; $i<count($array[6]); $i++){
                        ?>
                        <tr id="<?=$array[6][$i] ?>">
                            <td><?=$array[0][$i] ?></td>
                            <td><?=$array[7][$i] ?></td>
                            <td><?=$array[2][$i] ?></td>
                            <td><?=$array[1][$i] ?></td>
                            <td><?=$array[3][$i] ?></td>
                            <td><?=$array[5][$i].".00" ?></td>
                            <td><button class="btn btn-primary" onclick="accept(<?=$array[6][$i] ?>, false)">Accept</button></td>
                            <td><button class="btn btn-danger" onclick="deletePayment(<?=$array[6][$i] ?>, false)">Cancel</button></td>
                        </tr>
                    <?php
                    }
                ?>                     
                    </tbody>
                </table>
            </div>
            <ul class="pagination">
                <li class="page-item" >
                    <a class="page-link" href="javascript:void(0)" <?php if($num_page == 0){ echo "disabled"; }else{ ?> onclick = "displayTable('certificate', <?=$num_page-1 ?>);" <?php } ?>>&laquo;</a>
                </li>
                <?php
            for($x = 1; $x<=$array[8]; $x++){
                ?>
                <li class="page-item <?=($x==$num_page)? "active": "" ?>">
                    <a class="page-link" href="javascript:void(0)" onclick="displayTable('certificate', <?=$x ?>);"><?=$x ?></a>
                </li>
                <?php
            }
                ?>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" <?php if($array[8] == $num_page){ echo "disabled"; }else{ ?> onclick = "displayTable('certificate', <?=$num_page+1 ?>);" <?php } ?>>&raquo;</a>
                </li>
            </ul>
            <?php
        }else{
            echo "<h2><b>No Record..</b></h2>";
        }
    }elseif($content=='cashout_out_table'){

        $array = array();
        $name = array();
        $date_cashout = array();
        $time_cashout = array();
        $cashout_amount = array();
        $cashout_refnum = array();
        $cashout_id = array();
        try {
            $sql = mysqli_query($connect, "SELECT CAST(cashout_tb.cashout_date AS DATE) AS date_cashout, CAST(cashout_tb.cashout_date AS TIME) AS time_cashout, telleruser_tb.store_name, cashout_tb.cashout_amount, cashout_tb.cashout_refnum, cashout_tb.cashout_id FROM cashout_tb INNER JOIN telleruser_tb ON cashout_tb.teller_id = telleruser_tb.teller_id WHERE cashout_tb.cashout_status = 'pending' ORDER BY cashout_tb.cashout_id DESC LIMIT $offset, 5;");
            while($row = mysqli_fetch_assoc($sql)){
                $name[] = $row['store_name'];
                $date_cashout[] = date("m-d-Y", strtotime($row['date_cashout']));
                $time_cashout[] = date("h:i:s a", strtotime($row['time_cashout']));
                $cashout_amount[] = $row['cashout_amount'];
                $cashout_refnum[] = $row['cashout_refnum'];
                $cashout_id[] = $row['cashout_id'];
            }
        } catch (\Throwable $th) {
            echo $th;
        }

        try {
            $num_sql = mysqli_query($connect, "SELECT CAST(cashout_tb.cashout_date AS DATE) AS date_cashout, CAST(cashout_tb.cashout_date AS TIME) AS time_cashout, telleruser_tb.store_name, cashout_tb.cashout_amount, cashout_tb.cashout_refnum FROM cashout_tb INNER JOIN telleruser_tb ON cashout_tb.teller_id = telleruser_tb.teller_id WHERE cashout_tb.cashout_status = 'pending';");
            $num_row = ceil(mysqli_num_rows($num_sql)/5);
        } catch (\Throwable $th) {
            echo $th;
        }
        array_push($array, $date_cashout, $name, $time_cashout, $cashout_amount, $cashout_refnum, $cashout_id ,$num_row);
        if(count($array[5])!=0){
        ?>
            <div class="table-div mt-3">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Name</th>
                            <th scope="col">Reference #</th>
                            <th scope="col">Amount</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php
                    for($i = 0; $i<count($array[5]); $i++){
                        ?>
                        <tr id="<?=$array[5][$i] ?>">
                            <td><?=$array[0][$i] ?></td>
                            <td><?=$array[2][$i] ?></td>
                            <td><?=$array[1][$i] ?></td>
                            <td><?=$array[4][$i] ?></td>
                            <td><?=$array[3][$i].".00" ?></td>
                            <td><button class="btn btn-primary" onclick="accept(<?=$array[5][$i] ?>, true)">Accept</button></td>
                            <td><button class="btn btn-danger" onclick="deletePayment(<?=$array[5][$i] ?>, true)">Cancel</button></td>
                        </tr>
                    <?php
                    }
                ?>                     
                    </tbody>
                </table>
            </div>
            <ul class="pagination">
                <li class="page-item" >
                    <a class="page-link" href="javascript:void(0)" <?php if($num_page == 0){ echo "disabled"; }else{ ?> onclick = "displayTable('cashout_out_table', <?=$num_page-1 ?>);" <?php } ?>>&laquo;</a>
                </li>
                <?php
            for($x = 1; $x<=$array[6]; $x++){
                ?>
                <li class="page-item <?=($x==$num_page)? "active": "" ?>">
                    <a class="page-link" href="javascript:void(0)" onclick="displayTable('cashout_out_table', <?=$x ?>);"><?=$x ?></a>
                </li>
                <?php
            }
                ?>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" <?php if($array[6] == $num_page){ echo "disabled"; }else{ ?> onclick = "displayTable('cashout_out_table', <?=$num_page+1 ?>);" <?php } ?>>&raquo;</a>
                </li>
            </ul>
            <?php
        }else{
            echo "<h2><b>No Record..</b></h2>";
        }

    }
    

}
?>