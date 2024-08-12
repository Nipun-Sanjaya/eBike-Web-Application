<?php 

require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){
    $email = $_GET["e"];

    $resultset = Database::search("SELECT * FROM `users` WHERE `email`= '".$email."'");
    $n = $resultset->num_rows;

 if($n == 1){

    $code = uniqid();

    Database::iud("UPDATE `users` SET `verification_code`='".$code."' WHERE 
    `email`= '".$email."'");

    $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kanipunsanjaya14@gmail.com'; 
            $mail->Password = 'password'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('kanipunsanjaya14@gmail.com', 'eBike'); 
            $mail->addReplyTo('kanipunsanjaya14@gmail.com', 'eBike'); 
            $mail->addAddress($email); 
            $mail->isHTML(true);
            $mail->Subject = 'eBike Forget Password Varification Code.'; 
            $bodyContent = '<div style=" 
            width: 100%;
            height: 100vh;
            background-color: yellow;">
            <span style="color:red; font-size: 100px;">eBike</span><br><br>
            <span style="color:black; font-size: 25px;" >We are sending you this e-mail because you received a password reset. use this  Verification Code to create a new password. You can improve this mail if you didnt request a password reset. Your password will not be changed. </span>
            </div><h1 style="color:green; font-size: 60px;">Your verification code is : ' . $code . '</h1>';
            $mail->Body = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

            }else{
                   echo "Email address not found.";
               }


}else{
    echo "Please Enter Your Email Address.";
 }

?>