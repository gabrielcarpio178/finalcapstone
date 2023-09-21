<?php
require('Dbconnection.php');
if(isset($_POST['search'])){
    $search = $_POST['search'];
    try {
        $sql = mysqli_query($connect, "SELECT user_tb.user_id, user_tb.firstname, user_tb.lastname, user_tb.email, user_tb.phonenumber, user_tb.address, student_tb.course, personnel_tb.department, user_tb.usertype FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id WHERE user_tb.firstname LIKE '".$search."%' OR user_tb.lastname LIKE '".$search."%' LIMIT 0, 5;");
    } catch (\Throwable $th) {
        echo $th;
    }

}
$count = mysqli_num_rows($sql);

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
            <th scope="col" colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    while($row = mysqli_fetch_assoc($sql)){
    ?>
        <tr>
            <td><?php echo ($row['usertype']=='student')?$row['course']: $row['department']?></td>
            <td><?=$row['firstname']." ".$row['lastname'] ?></td>
            <td><?=$row['email'] ?></td>
            <td><?="0".$row['phonenumber'] ?></td>
            <td><?php echo ($row['address']=="bago")?ucfirst($row['address'])." City": ucfirst($row['address']) ?></td>
            <td class="action" onclick="edit(<?=$row['user_id'] ?>)" ><i class="fas fa-edit" style="#282828de"></i></td>
            <td class="action"><i class="fa-solid fa-trash" style="#282828de"></i></td>
        </tr>
    <?php } }else{ ?>
        <p>No Record</p>
        <?php } ?>
    </tbody>
</table>