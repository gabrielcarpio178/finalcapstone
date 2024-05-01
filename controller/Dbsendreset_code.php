<?php
sleep(1);
require '../vendor/autoload.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
session_start();
if(isset($_POST['reset_code'])&&isset($_POST
['email_user'])){
    $reset_code = $_POST['reset_code'];
    $email_user = strtoupper($_POST['email_user']);
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);                  
    try {
        $mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'bccdigitalpaymentsystem@gmail.com';     
        $mail->Password = 'vjdj enai tven hpyu';             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   

        $mail->setFrom('bccdigitalpaymentsystem@gmail.com');

        $mail->addAddress($email_user);              
$reset_code;
        $mail->isHTML(true);                                  
        $mail->Subject = "BCC DIGITAL PAYMENT SYSTEM";
        $mail->Body    = "Hi ".$email_user.",

        We received a request to reset your password.
        Please enter your verification code: 
        ".$reset_code;

        $mail->send();
        $_SESSION['email_to'] = $email_user;
        echo "send_success";
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
        echo 'error';
    }

}
?>