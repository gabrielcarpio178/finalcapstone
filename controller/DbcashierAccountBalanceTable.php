<?php
require('Dbconnection.php');
if(isset($_POST['search'])&&isset($_POST['sortBy'])&&isset($_POST['page_num'])&&isset($_POST['semesterYear_data'])&&isset($_POST['semester_category'])){
    $search = $_POST['search'];
    $sortBy = $_POST['sortBy'];
    $page_num = $_POST['page_num'];
    $year = $_POST['semesterYear_data'];
    $category = $_POST['semester_category'];
    
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

    if($category=='all'){
        $category_cot = " ";
    }else{
        $category_cot = " AND `semester`='".$category."'";
    }

    if($year=='current_year'){
        if($category=='all'){
            $category_cot = " ";
        }else{
            $category_cot = " WHERE `semester`='".$category."'";
        }
        $year_cot = $category_cot.' ORDER BY semesterYear_id DESC LIMIT 1';
    }else {
        $year_cot = " WHERE `semester_pair`='".$year."'".$category_cot."";
    }

    try {
        $sql_semester = mysqli_query($connect, "SELECT `semester`, `semester_start`, `semester_end`, `semester_pair` FROM `semesteryear_tb`".$year_cot);
        $isEmpty = false;
        $array_year = array();
        $year_data = array();
        while($semester_row = mysqli_fetch_assoc($sql_semester)){
            $year_data = array($semester_row['semester_start'], $semester_row['semester_end']);
            $array_year = array_merge($array_year, $year_data);
            $isEmpty = true;
        }
        sort($array_year);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($array_year[0]==""){
        $start_sem = $array_year[1];
    }else{
        $start_sem = $array_year[0];
    }
    $end_sem = $array_year[count($array_year)-1];

    if($year=='current_year'){
        $query = "SELECT student_tb.studentID_number, user_tb.firstname, user_tb.lastname, student_tb.course, user_tb.address, digitalpayment_tb.payment_type, digitalpayment_tb.requestType FROM user_tb INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN digitalpayment_tb ON user_tb.user_id = digitalpayment_tb.user_id WHERE (CAST(digitalpayment_tb.payment_date AS DATE) BETWEEN '$start_sem' AND CAST(NOW() AS DATE) OR digitalpayment_tb.payment_type IS NULL) AND ((digitalpayment_tb.payment_type = 'Non Bago Fee' OR digitalpayment_tb.payment_type IS NULL) AND (user_tb.address = 'non-bago' OR digitalpayment_tb.requestType = 'accepted')".$search_data.$sortBy.") ORDER BY digitalpayment_tb.digitalPayment_id DESC LIMIT ".$offset." , 5";
    
        $query_count = "SELECT student_tb.studentID_number, user_tb.firstname, user_tb.lastname, student_tb.course, user_tb.address, digitalpayment_tb.payment_type, digitalpayment_tb.requestType FROM user_tb INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN digitalpayment_tb ON user_tb.user_id = digitalpayment_tb.user_id WHERE (CAST(digitalpayment_tb.payment_date AS DATE) BETWEEN '$start_sem' AND CAST(NOW() AS DATE) OR digitalpayment_tb.payment_type IS NULL) AND ((digitalpayment_tb.payment_type = 'Non Bago Fee' OR digitalpayment_tb.payment_type IS NULL) AND (user_tb.address = 'non-bago' OR digitalpayment_tb.requestType = 'accepted')".$search_data.$sortBy.") ORDER BY digitalpayment_tb.digitalPayment_id DESC";
    }else {
        $query = "SELECT student_tb.studentID_number, user_tb.firstname, user_tb.lastname, student_tb.course, user_tb.address, digitalpayment_tb.payment_type, digitalpayment_tb.requestType FROM user_tb INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN digitalpayment_tb ON user_tb.user_id = digitalpayment_tb.user_id WHERE (CAST(digitalpayment_tb.payment_date AS DATE) BETWEEN '$start_sem' AND '$end_sem' OR digitalpayment_tb.payment_type IS NULL) AND ((digitalpayment_tb.payment_type = 'Non Bago Fee' OR digitalpayment_tb.payment_type IS NULL) AND (user_tb.address = 'non-bago' OR digitalpayment_tb.requestType = 'accepted')".$search_data.$sortBy.") ORDER BY digitalpayment_tb.digitalPayment_id DESC LIMIT ".$offset." , 5";
    
        $query_count = "SELECT student_tb.studentID_number, user_tb.firstname, user_tb.lastname, student_tb.course, user_tb.address, digitalpayment_tb.payment_type, digitalpayment_tb.requestType FROM user_tb INNER JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN digitalpayment_tb ON user_tb.user_id = digitalpayment_tb.user_id WHERE (CAST(digitalpayment_tb.payment_date AS DATE) BETWEEN '$start_sem' AND '$end_sem' OR digitalpayment_tb.payment_type IS NULL) AND ((digitalpayment_tb.payment_type = 'Non Bago Fee' OR digitalpayment_tb.payment_type IS NULL) AND (user_tb.address = 'non-bago' OR digitalpayment_tb.requestType = 'accepted')".$search_data.$sortBy.") ORDER BY digitalpayment_tb.digitalPayment_id DESC";
    }
    
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