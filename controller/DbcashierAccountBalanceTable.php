<?php
require('Dbconnection.php');
if(isset($_POST['search'])&&isset($_POST['sortBy'])&&isset($_POST['page_num'])){
    $search = $_POST['search'];
    $sortBy = $_POST['sortBy'];
    $page_num = $_POST['page_num'];

    if($page_num==0){
        $offset = 0;
    }else{
        $offset = ($page_num-1)*5;
    }

    if($search == ''){
        $search_data = "";
    }else{
        $search_data = " AND (student_tb.studentID_number LIKE '".$search."%' OR user_tb.firstname LIKE '".$search."%' )";
    }

    if($sortBy=='all'){
        $sortBy = "";
    }else if($sortBy=='paid'){
        //accepted
        $sortBy = " AND (digitalpayment_tb.requestType = 'accepted' AND digitalpayment_tb.payment_type = 'Non Bago Fee')";
    }else if($sortBy=='unpaid'){
        $sortBy = " AND (digitalpayment_tb.requestType = 'pending' OR digitalpayment_tb.payment_type IS NULL)";
    }

    $query = "SELECT student_tb.studentID_number, user_tb.firstname, user_tb.lastname, student_tb.course, user_tb.address, digitalpayment_tb.payment_type, digitalpayment_tb.requestType FROM user_tb INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN digitalpayment_tb ON user_tb.user_id = digitalpayment_tb.user_id WHERE (digitalpayment_tb.payment_type = 'Non Bago Fee' OR digitalpayment_tb.payment_type IS NULL) AND (user_tb.address = 'non-bago' OR digitalpayment_tb.requestType = 'accepted')".$search_data.$sortBy." ORDER BY digitalpayment_tb.digitalPayment_id DESC LIMIT ".$offset." , 5";
    
    $query_count = "SELECT student_tb.studentID_number, user_tb.firstname, user_tb.lastname, student_tb.course, user_tb.address, digitalpayment_tb.payment_type, digitalpayment_tb.requestType FROM user_tb INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN digitalpayment_tb ON user_tb.user_id = digitalpayment_tb.user_id WHERE (digitalpayment_tb.payment_type = 'Non Bago Fee' OR digitalpayment_tb.payment_type IS NULL) AND (user_tb.address = 'non-bago' OR digitalpayment_tb.requestType = 'accepted')".$search_data.$sortBy." ORDER BY digitalpayment_tb.digitalPayment_id DESC";

    try {
        $sql_count = mysqli_query($connect, $query_count);
        $countRow_non_bago = ceil(mysqli_num_rows($sql_count)/5);
    } catch (\Throwable $th) {
        echo $th;
    }

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
        <table id="table_result" class="table table-hover text-center">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody id="table_info">
                <?php

                while($row = mysqli_fetch_assoc($sql)){
                    ?>
                    <tr>
                        <td><?=($row['requestType']==NULL||$row['requestType']=="pending")?"Unpaid":"Paid" ?></td>
                        <td><?=$row['studentID_number'] ?></td>
                        <td><?=$row['firstname']." ".$row['lastname'] ?></td>
                        <td><?=$row['course'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <ul class="pagination pagination-sm">
            <li class="page-item" >
                <a class="page-link" href="javascript:void(0)" <?php if($page_num == 0){ echo "disabled"; }else{ ?> onclick = "page(<?=$page_num-1 ?>);" <?php } ?>>&laquo;</a>
            </li>
            <?php
            for($x = 1; $x<=$countRow_non_bago; $x++){
                ?>
                <li class="page-item <?=($x==$page_num)? "active": "" ?>">
                    <a class="page-link" href="javascript:void(0)" onclick = "page(<?=$x ?>);">
                        <?=$x ?>
                    </a>
                </li>
                <?php
            }
            ?>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)"
                <?php if($countRow_non_bago == $page_num){ echo "disabled"; }else{ ?> onclick = "page(<?=$page_num+1 ?>);" <?php } ?>>&raquo;</a>
            </li>
        </ul>
        <?php
    }
}
?>