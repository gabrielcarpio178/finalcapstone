<?php
require('Dbconnection.php');
if(isset($_POST['category'])&&isset($_POST['usertype'])&&isset($_POST['address'])&&isset($_POST['search'])){
    $category = $_POST['category'];
    $usertype = $_POST['usertype'];
    $address = $_POST['address'];
    $search = $_POST['search'];
    if($usertype = 'user_buyer'){

        $category_cot = ($category!='all')?" WHERE (student_tb.course = '$category' OR personnel_tb.department = '$category')":"";
        if($category=='all'){
            $address_cot = ($address!='all')?" WHERE user_tb.address = '$address'":"";
        }else{
            $address_cot = ($address!='all')?" AND user_tb.address = '$address'":"";
        }
        if($category=='all'&&$address=='all'){
            $search_info = ($search!="")?" WHERE user_tb.firstname LIKE '$search%' OR user_tb.lastname LIKE '$search%'":"";
        }else{
            $search_info = ($search!="")?" AND (user_tb.firstname LIKE '$search%' OR user_tb.lastname LIKE '$search%')":"";
        }
        
        $query = "SELECT user_tb.user_id, user_tb.firstname, user_tb.lastname, user_tb.email, user_tb.phonenumber, user_tb.address, student_tb.course, personnel_tb.department, user_tb.usertype FROM user_tb LEFT JOIN student_tb ON user_tb.user_id = student_tb.user_id LEFT JOIN personnel_tb ON user_tb.user_id = personnel_tb.user_id".$category_cot.$address_cot.$search_info;

        try {
            $sql = mysqli_query($connect, $query);
            $array_data = array();
            while($row = mysqli_fetch_assoc($sql)){
                if($row['course']==NULL){
                    $department = $row['department'];
                }else{
                    $department = $row['course'];
                }
                $array_data[] = array("name"=>$row['firstname']." ".$row['lastname'], "email"=>$row['email'], "phonenumber"=>$row['phonenumber'], "address"=>$row['address'], "department"=>$department, "user_id"=>$row['user_id']);
            }
            print_r(json_encode($array_data));
        } catch (\Throwable $th) {
            echo $th;
        }

    }
}
?>