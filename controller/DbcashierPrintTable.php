<?php
session_start();
require('Dbconnection.php');
if(isset($_POST['start_date'])&&isset($_POST['end_date'])&&isset($_POST['semester'])&&isset($_POST['currentDate'])&&isset($_POST['isPaid'])){
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $_SESSION['semester'] = $_POST['semester'];
    $_SESSION['currentDate'] = $_POST['currentDate'];
    $isPaid = $_POST['isPaid'];

    if($isPaid=='all'){
        $isPaid = "";
    }else if($isPaid=='paid'){
        $isPaid = " AND (digitalpayment_tb.requestType = 'accepted' AND digitalpayment_tb.payment_type = 'Non Bago Fee')";
    }else if($isPaid=='unpaid'){
        $isPaid = " AND (digitalpayment_tb.requestType = 'pending' OR digitalpayment_tb.payment_type IS NULL)";
    }

    $query = "SELECT student_tb.studentID_number, user_tb.firstname, user_tb.lastname, student_tb.course, user_tb.address, digitalpayment_tb.payment_type, digitalpayment_tb.requestType, CAST(digitalpayment_tb.payment_date AS DATE) AS paid_date, digitalpayment_tb.payment_ref FROM user_tb INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN digitalpayment_tb ON user_tb.user_id = digitalpayment_tb.user_id WHERE (CAST(digitalpayment_tb.payment_date AS DATE) BETWEEN '$start_date' AND '$end_date' OR digitalpayment_tb.payment_type IS NULL) AND ((digitalpayment_tb.payment_type = 'Non Bago Fee' OR digitalpayment_tb.payment_type IS NULL) AND (user_tb.address = 'non-bago' OR digitalpayment_tb.requestType = 'accepted')".$isPaid.") ORDER BY digitalpayment_tb.digitalPayment_id DESC";

    try {
        $sql = mysqli_query($connect, $query);
        $count = mysqli_num_rows($sql);
    } catch (\Throwable $th) {
        echo $th;
    }

    if($count == 0){
        echo "No Record";
    }else{
        ?>
        <div class="table-scroll">
            <table id="table_result" class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Reference #</th>
                        <th>Date Paid</th>
                    </tr>
                </thead>
                <tbody id="table_info">
                    <?php

                    while($row = mysqli_fetch_assoc($sql)){
                        ?>
                        <tr>
                            <td><div class="<?=($row['requestType']==NULL||$row['requestType']=="pending")?"unpaid":"paid"?>"><?=($row['requestType']==NULL||$row['requestType']=="pending")?"Unpaid":"Paid" ?></td>
                            <td><?=$row['studentID_number'] ?></div></td>
                            <td><?=$row['firstname']." ".$row['lastname'] ?></td>
                            <td><?=$row['course'] ?></td>
                            <td><?=($row['payment_ref']==NULL)?"-- -- --": $row['payment_ref']?></td>
                            <td><?=($row['paid_date']==NULL)?"-- -- --":  $row['paid_date']?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}
?>