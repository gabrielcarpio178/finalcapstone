<?php
require('Dbconnection.php');
// print_r($_POST);
if(isset($_POST['search'])){
       $search = "WHERE CAST(post_date AS DATE) LIKE "."'".$_POST['search']."'";
    if($_POST['search']==""){
        $search = "";
    }

    if(isset($_POST['number_data'])){
        $num_per_page = $_POST['number_data'];
    }else{
        $num_per_page = 5;
    }
}

if(isset($_POST['num'])){
    $page_num = $_POST['num'];
    if(!isset($_POST['search'])){
        $search = "";
        $num_per_page = 5;
    }elseif(!isset($_POST['search'])||!isset($_POST['number_data'])){
        $num_per_page = 5;
    }else{
        $search = "WHERE CAST(post_date AS DATE) LIKE "."'".$_POST['search']."'";
        $num_per_page = 5;
    }
}

if(isset($_POST['number_data'])){
    $number_data = $_POST['number_data'];
    $num_per_page = $number_data;
    if(!isset($_POST['search'])){
        $search = "";
    }
}

if(isset($_POST['post_to'])){
    if(!isset($_POST['search'])){
        $search = "WHERE post_type = '".$_POST['post_to']."'";
    }else{
        $search = "WHERE CAST(post_date AS DATE) LIKE "."'".$_POST['search']."' AND post_type = '".$_POST['post_to']."'";
    }
}




$sql_num = mysqli_query($connect, 'SELECT count(*) AS num_post FROM adminannoucement '.$search) or die(mysqli_error($connect));
$num_row = mysqli_fetch_assoc($sql_num);


$num_page =  ceil($num_row['num_post']/$num_per_page);
$offset = ($page_num-1)*$num_per_page;

try {
    $sql = mysqli_query($connect, 'SELECT posted ,announcement_id, post, MONTHNAME(CAST(post_date AS DATE)) AS month, DAY(CAST(post_date AS DATE)) AS day, YEAR(CAST(post_date AS DATE)) AS year, TIME_FORMAT(CAST(post_date AS TIME), "%h:%i %p") AS time, post_type FROM adminannoucement '.$search.' ORDER BY announcement_id DESC LIMIT '.$offset.", ".$num_per_page);
} catch (\Throwable $th) {
    echo $th;
}

?>


<table class="table table-hover text-center">

    <thead>
        <tr>
            <th scope="col">POST TO</th>
            <th scope="col">Anouncement</th>
            <th scope="col">DATE TIME</th>
            <th scope="col">ACTIVE</th>
            <th scope="col" colspan="2">ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php if(mysqli_num_rows($sql)==0){
                echo "<tr>No Record</tr>";
        } ?>
        <?php while($row = mysqli_fetch_assoc($sql)){
           ?>
        <tr>
            <td><?=$row['post_type'] ?></td>
            <td class="text-start"><?=$row['post'] ?></td>
            <td><?=$row['month']." ".$row['day'].", ".$row['year']." ".$row['time'] ?></td>
            <td><input type="checkbox" <?php echo ($row['posted']=='active')? 'checked':''; ?> disabled></td>
            <td class="action_info" onclick="edit('<?=$row['announcement_id'] ?>');" data-toggle="modal" data-target="#edit"><i class="fas fa-edit" style="#282828de"></i></td>
            <td class="action_info" onclick="delete_post('<?=$row['announcement_id'] ?>');"><i class="fa-solid fa-trash" style="#282828de"></i></td>
        </tr>
        <?php }  ?>
    </tbody>

</table>

<ul class="pagination">
    <li class="page-item" >
        <a class="page-link" href="javascript:void(0)" <?php if($page_num == 1){ echo "disabled"; }else{ ?> onclick = "prev('<?=$page_num-1 ?>');" <?php } ?>>&laquo;</a>
    </li>
    <?php for($i = 1; $i <=$num_page; $i++){ ?>
        <li class="page-item <?=($i==$page_num)? "active": "" ?>">
            <a class="page-link" href="javascript:void(0)" onclick="page('<?=$i ?>');" ><?=$i ?></a>
        </li>
    <?php } ?>
    <li class="page-item">
        <a class="page-link" href="javascript:void(0)" <?php if($page_num==$num_page){ echo "disabled"; }else{ ?> onclick = "next('<?=$page_num+1 ?>');" <?php } ?> >&raquo;</a>
    </li>
</ul>