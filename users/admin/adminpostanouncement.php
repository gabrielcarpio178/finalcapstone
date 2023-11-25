<?php
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="admin")){
   if(!isset($_SERVER['HTTP_REFERER'])){
       header('location: ../../index.php');
    exit;
   }
}

$sql_num = mysqli_query($connect, 'SELECT count(*) AS num_post FROM adminannoucement;') or die(mysqli_error($connect));
$num_row = mysqli_fetch_assoc($sql_num);

try {
    $sql = mysqli_query($connect, 'SELECT posted ,announcement_id, post, MONTHNAME(CAST(post_date AS DATE)) AS month, DAY(CAST(post_date AS DATE)) AS day, YEAR(CAST(post_date AS DATE)) AS year, TIME_FORMAT(CAST(post_date AS TIME), "%h:%i %p") AS time, post_type FROM adminannoucement ORDER BY announcement_id DESC LIMIT 0,5;');
    $count_row = mysqli_num_rows($sql);
} catch (\Throwable $th) {
    echo $th;
}
$num_data = 5;
$num_page = ceil($num_row['num_post']/ $num_data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/interfont.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">  
    <link rel="stylesheet" href="../../css/adminpostanouncement.css">
    <title>Post anouncement</title>
</head>
<body>
    <div id="nav"></div>

    <div class="content">

        <h1>Post Announcements</h1>
        <div class="post-btn" data-bs-toggle="modal" data-bs-target="#post" id="btn_post">
            <img src="../../image/post.png">
            <h3>Post Announcements</h3>
        </div> 
        <input type="date" class="search-btn" id="search" />

        <div class="container">

            <div class="post-menu" id="post1">
                <ul class="post-nav">
                    <li class="active" id="all" >All</li>
                    <li class="active" id="recent">
                        <div class="dropdown">
                            <select name="post_to_filer" id="post_to_filer" class="form-select form-select-sm">
                                <option disabled selected value="0">Post to<i class="fa fa-caret-down"></i></option>
                                <option value="All">All</option>
                                <option value="Buyer">Buyer Only</option>
                                <option value="Canteen Staff">Canteen Staff Only</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown">
                            <select name="sortby" id="sortby" class="form-select form-select-sm">
                                <option disabled selected value="0">Show Number of Data <i class="fa fa-caret-down"></i></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        <div id="table-info" class="table-class">
        
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
                    <?php while($row = mysqli_fetch_assoc($sql)){ ?>
                    <tr>
                        <td><?=$row['post_type'] ?></td>
                        <td class="text-start"><?=$row['post'] ?></td>
                        <td><?=$row['month']." ".$row['day'].", ".$row['year']." ".$row['time'] ?></td>
                        <td><input type="checkbox" <?php echo ($row['posted']=='active')? 'checked':''; ?> disabled></td>
                        <td class="action_info" onclick="edit('<?=$row['announcement_id'] ?>');" data-toggle="modal" data-target="#edit"><i class="fas fa-edit" style="#282828de"></i></td>
                        <td class="action_info" onclick="delete_post('<?=$row['announcement_id'] ?>');"><i class="fa-solid fa-trash" style="#282828de"></i></td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>          
            
            <ul class="pagination">
                <li class="page-item" >
                    <a class="page-link" href="javascript:void(0)" <?php if($num_page == 1){ echo "disabled"; }else{ ?> onclick = "prev('<?=$num_page-1 ?>');" <?php } ?>>&laquo;</a>
                </li>
                <?php for($i = 1; $i <=$num_page; $i++){ ?>
                    <li class="page-item <?=($i==1)? "active": "" ?>">
                        <a class="page-link" href="javascript:void(0)" onclick="page('<?=$i ?>');" ><?=$i ?></a>
                    </li>
                <?php } ?>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" <?php if(1==$num_page){ echo "disabled"; }else{ ?> onclick = "next('<?=1+1 ?>');" <?php } ?>>&raquo;</a>
                </li>
            </ul>

        </div>


    </div>  
    



    <div class="modal fade" id="post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Post Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="post_announcement">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="input_post" class="form-label">Post Announcement</label>
                            <textarea class="form-control" id="input_post" name="input_post" rows="4" style="height: 208px;"></textarea>
                        </div>

                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="post_to" name="post_to">
                            <option selected disabled value="empty">Post to</option>
                            <option value="All">All</option>
                            <option value="Buyer">Buyer Only</option>
                            <option value="Cashier">Cashier Only</option>
                            <option value="Canteen Staff">Canteen Staff Only</option>
                        </select>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="POST" class="btn btn-primary" >
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Announcement</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_announcement">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="input_post" class="form-label">Edit Announcement</label>
                        <textarea class="form-control" id="edit_post" name="edit_post" rows="4" style="height: 208px;"></textarea>
                        <input type="hidden" name="id" id="id">
                    </div>

                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="edit_post_to" name="post_to">
                        <option selected disabled value="empty">Post to</option>
                        <option value="All">All</option>
                        <option value="Buyer">Buyer Only</option>
                        <option value="Canteen Staff">Canteen Staff Only</option>
                    </select>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="SAVE" class="btn btn-primary" >
                </div>
            </form>
            </div>
        </div>
    </div>
                </div>
    
</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/sweetalert2.all.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/adminpostanouncement.js"></script>
</html>