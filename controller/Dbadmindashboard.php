<?php
require('Dbconnection.php');
if(isset($_POST['admin'])){

    try {
        $sql_all = mysqli_query($connect, "SELECT COUNT(*) AS all_user FROM user_tb WHERE usertype IS NOT NULL;");
        $all = mysqli_fetch_assoc($sql_all);
        if(empty($all)){
            $all['all_user'] = 0;
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_new_user = mysqli_query($connect, "SELECT COUNT(*) AS all_week FROM user_tb WHERE usertype IS NOT NULL AND WEEK(register_date, 0) LIKE WEEK(CAST(now() AS DATE), 0);");
        $all_week = mysqli_fetch_assoc($sql_new_user);
        if(empty($all_week)){
            $all_week['all_week'] = 0;
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    try {
        $sql_active_user = mysqli_query($connect, "SELECT COUNT(*) AS all_active FROM user_tb WHERE usertype IS NOT NULL AND statues = 'active' GROUP BY statues;");
        $all_active = mysqli_fetch_assoc($sql_active_user);
        if(empty($all_active)){
            $all_active['all_active'] = 0;
        }
    } catch (\Throwable $th) {
        echo $th;
    }

    $data = array();
    $data['all_user'] = $all['all_user'];
    $data['all_week'] = $all_week['all_week'];
    $data['all_active'] = $all_active['all_active'];
    print_r(json_encode($data));

}
?>