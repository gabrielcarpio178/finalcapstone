<?php
require("Dbconnection.php");
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$url = "https://bagocitycollege.com/BCCWeb/TPLoginAPI";


$data_array = array(
    'txtUserName'=> $username,
    'txtPassword' => $password,
    'txtCallback' => '',
    'txtRequestId' => '',
);
$data = http_build_query($data_array);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if($e = curl_error($ch)){
    echo $e;
}
else{
    $decoded = json_decode($response);
    if(isset($decoded->user_group)){
        if($decoded->user_group == "STUDENT"){
            $firstname = $decoded->first_name;
            $lastname = $decoded->last_name;
            $email = $decoded->email_address;
            $phonenumber = $decoded->cp_number;
            $gender = strtolower($decoded->gender);
            $student_id = $decoded->user_code;
            $addressapi = $decoded->address;
            $rfid = $decoded->rfid;
            $department = $decoded->program_code;
            if(($decoded->program_code)=="IS"){
                $department = "BSIS";
            }elseif(($decoded->program_code)=="BSOA"){
                $department = "BSOA";
            }elseif(($decoded->program_code)=="CRIM"){
                $department = "BSCRIM";
            }else{
                $educ = array("BSEDFIL", "BSEDMATH");
                for($i=0;$i<count($educ);$i++){
                    if($educ[$i]==($decoded->program_code)){
                        $department = "BSED";
                        break;
                    }
                }
            }
            
            if(($decoded->year_level)==1){
                $year = "1st";
            }elseif(($decoded->year_level)==2){
                $year = "2nd";
            }elseif(($decoded->year_level)==3){
                $year = "3rd";
            }elseif(($decoded->year_level)==4){
                $year = "4th";
            }
            $bago = "BAGO";
            if(str_contains($addressapi ,$bago)){
                $address = "bago";
            }else{
                $address = "non-bago";
            }
            $passwordmd = md5(strtolower($password));
            try {
                mysqli_query($connect,"INSERT INTO `user_tb`(`firstname`, `lastname`, `email`, `phonenumber`, `gender`, `address`, `user_category`, `usertype`, `statues`, `username`, `password`) VALUES ('$firstname','$lastname','$email','$phonenumber', '$gender', '$address', 'user_buyer', 'student', 'active', '$username','$passwordmd');");
            } catch (\Throwable $th) {
                echo $th;
            }
            
            try {
                $sql = mysqli_query($connect, "SELECT user_id, email, usertype, gender FROM user_tb WHERE password='$passwordmd';");
                $row = mysqli_fetch_assoc($sql);
            } catch (\Throwable $th) {
                echo $th;
            }

            $getemail = $row['email'];
            $id = $row['user_id'];

            try {
                mysqli_query($connect, "INSERT INTO `student_tb`(`studentID_number`, `user_id`, `course`, `year`, `rfid_number`) VALUES ('$student_id','$id','$department','$year', '$rfid');");
            } catch (\Throwable $th) {
                echo $th;
            }

            $_SESSION['id']=$id;
            $_SESSION['usertype'] = $row['usertype'];
            $_SESSION['gender'] = $row['gender'];
            echo "login";
        }
        else if($decoded->user_group == "REGISTRAR"){
            print_r($decoded);
        }
        else{
            echo "Invalid Credentials";
        }
    }else{
        echo "Invalid Credentials";
    }
}
curl_close($ch);

?>