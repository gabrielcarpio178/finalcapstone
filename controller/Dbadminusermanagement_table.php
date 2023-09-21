<?php
require('Dbconnection.php');
if(isset($_POST['category'])&&isset($_POST['usertype'])&&isset($_POST['add_row'])&&isset($_POST['address'])&&isset($_POST['page'])){
    $category = $_POST['category'];
    $usertype = $_POST['usertype'];
    $num_row = $_POST['add_row'];
    $address = $_POST['address'];
    $page = $_POST['page'];
    if($category!='teller'){
        
        if($page==0){
            $offset = 0;
        }else{
            $offset = ($page-1)*$num_row;
        }
        $query = "SELECT user_tb.user_id, user_tb.firstname, user_tb.lastname, user_tb.email, user_tb.phonenumber, user_tb.address, student_tb.course, personnel_tb.department, user_tb.usertype FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id";
        $limit = " LIMIT ".$offset." ,".$num_row;
        $sql = $query." LIMIT ".$offset.",".$num_row;

        if($usertype=='student'){
            $table = " WHERE student_tb.course = '";
        }elseif($usertype=='personnel'){
            $table = " WHERE personnel_tb.department = '";
        }

        if($category == 'All'&&$address=='ALL'){
            $sql_num = $query;
            $sql = $query."".$limit;
        }elseif($category == 'All'&&$address!='ALL'){
            $sql_num = $query." WHERE user_tb.address = '".$address."'";
            $sql = $query." WHERE user_tb.address = '".$address."'".$limit;
        }else{
            $sql = $query.$table.$category."'".$limit;
        }
        
        if($address == 'ALL'){
            $address = "".$limit;
            $address_num = "";
        }else{
            $address = " AND user_tb.address = '".$_POST['address']."'".$limit;
            $address_num = " AND user_tb.address = '".$_POST['address']."'";
        }

        if($category != 'All'){
            $sql_num = $query.$table.$category."'".$address_num;
            $sql = $query.$table.$category."'".$address;
            
        }elseif($address == 'ALL'&&!isset($table)){
            $sql_num = $query."'".$category.$address_num;
            $sql = $query."'".$category.$address;
        }elseif($address == 'ALL'&&isset($table)){
            $sql_num = $query.$table.$category."'".$address_num;
            $sql = $query.$table.$category."'".$address;
        }
            
        try {
            $sql_row = mysqli_query($connect, $sql);
        } catch (\Throwable $th) {
            echo $th;
        }

        try {
            $sql_nums = mysqli_query($connect, $sql_num);
        } catch (\Throwable $th) {
            echo $th;
        } 

        $data_num = mysqli_num_rows($sql_nums);
        $page_num = ceil($data_num/$num_row);

$count = mysqli_num_rows($sql_row);

    if($count>0){
?>


<table class="table table-hover text-center">
    <thead>
        <tr>
            <th scope="col">Department</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone number</th>
            <th scope="col">Address</th>
            <th scope="col">Reset Password</th>
        </tr>
    </thead>
    <tbody>
    <?php
    while($row = mysqli_fetch_assoc($sql_row)){
    ?>
        <tr>
            <td><?php echo ($row['usertype']=='student')?$row['course']: $row['department']?></td>
            <td><?=ucfirst($row['firstname'])." ".ucfirst($row['lastname']) ?></td>
            <td><?=$row['email'] ?></td>
            <td><?="0".$row['phonenumber'] ?></td>
            <td class="address_class"><?php echo ($row['address']=="bago")?ucfirst($row['address'])." City": ucfirst($row['address']) ?></td>
            <td class="action" onclick="edit('<?=$row['user_id'] ?>', 'buyer')" ><i class="fas fa-edit" style="#282828de"></i></td>
        </tr>
    <?php } }else{ ?>
        <p>No Record</p>
        <?php } ?>
    </tbody>
</table>

<ul class="pagination">
    <li class="page-item" >
        <a class="page-link" href="javascript:void(0)" <?php if($page == 1){ echo "disabled"; }else{ ?> onclick = "page_num('<?=$page-1 ?>');" <?php } ?>>&laquo;</a>
    </li>
    <?php for($i = 1; $i <=$page_num; $i++){ ?>
        <li class="page-item <?=($i==$page)? "active": "" ?>">
            <a class="page-link" href="javascript:void(0)" onclick="page_num(<?=$i ?>)" ><?=$i ?></a>
        </li>
    <?php } ?>
    <li class="page-item">
        <a class="page-link" href="javascript:void(0)" <?php if($page == $page_num){ echo "disabled"; }else{ ?> onclick = "page_num('<?=$page+1 ?>');" <?php } ?>>&raquo;</a>
    </li>
</ul>

<?php 
    }else{
        

        $query = "SELECT `teller_id`, `firstname_teller`, `lastname_teller`, `phonenumber_teller`, `store_name`, `teller_gender`, `teller_qr`, `tellerqr_image`, `user_category` FROM `telleruser_tb` ORDER BY `teller_id` DESC";

        if($page == 0){
            $offset = 0;
        }else{
            $offset = ($page-1)*$num_row;
        }
        $sql = $query." LIMIT ".$offset.",".$num_row;

        try {
            $teller_sql = mysqli_query($connect, $sql);
        } catch (\Throwable $th) {
            echo $th;
        }

        try {
            $teller_num = mysqli_query($connect, $query);
        } catch (\Throwable $th) {
            echo $th;
        }

        $data_num = mysqli_num_rows($teller_num);
        $page_num = ceil($data_num/$num_row);
        


        $count = mysqli_num_rows($teller_sql);
        if($count>0){
?>

<table class="table table-hover text-center">
    <thead>
        <tr>
            <th scope="col">Store Name</th>
            <th scope="col">Name</th>
            <th scope="col">Phone number</th>
            <th scope="col">View QR</th>
            <th scope="col">Reset Password</th>
        </tr>
    </thead>
    <tbody>
    <?php
    while($row = mysqli_fetch_assoc($teller_sql)){
    ?>
        <tr>
            <td><?=ucfirst($row['store_name']) ?></td>
            <td><?=ucfirst($row['firstname_teller'])." ".ucfirst($row['lastname_teller']) ?></td>
            <td><?=$row['phonenumber_teller'] ?></td>
            <td class="action" onclick="viewqr('<?=$row['teller_id'] ?>');"><i class="fa-solid fa-eye"></i></td>
            <td class="action" onclick="edit('<?=$row['teller_id'] ?>', 'teller')"><i class="fas fa-edit" style="#282828de"></i></td>
        </tr>
    <?php } }else{ ?>
        <p>No Record</p>
        <?php } ?>
    </tbody>
</table>

<ul class="pagination">
    <li class="page-item" >
        <a class="page-link" href="javascript:void(0)" <?php if($page == 1){ echo "disabled"; }else{ ?> onclick = "page_num('<?=$page-1 ?>');" <?php } ?>>&laquo;</a>
    </li>
    <?php for($i = 1; $i <=$page_num; $i++){ ?>
        <li class="page-item <?=($i==$page)? "active": "" ?>">
            <a class="page-link" href="javascript:void(0)" onclick="page_num(<?=$i ?>)" ><?=$i ?></a>
        </li>
    <?php } ?>
    <li class="page-item">
        <a class="page-link" href="javascript:void(0)" <?php if($page == $page_num){ echo "disabled"; }else{ ?> onclick = "page_num('<?=$page+1 ?>');" <?php } ?>>&raquo;</a>
    </li>
</ul>

 <?php   
        }    
    }



?>