<?php

use PHPMailer\PHPMailer\PHPMailer;

require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

$new_category = $_POST["n"];
$user_email = $_POST["e"];

$category_rs = Database::search("SELECT * FROM `category` WHERE `name` LIKE '%".$new_category."%'");
$category_num = $category_rs->num_rows;

if($category_num == 0){

    $code = uniqid();

    Database::iud("UPDATE `admin` SET `code`='".$code."' WHERE `email`='".$user_email."'");

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
        $mail->addAddress($user_email);
        $mail->isHTML(true);
        $mail->Subject = 'Admin Verification Code';
        $bodyContent = '<div style=" 
        width:100%;
        height: 250px;
        background-color: yellow;">
        <span style="color:red; font-size: 100px;">eBike</span><br><br>
        <span style="color:black; font-size: 25px;" >Please confirm if you want to add a new Brand of bike. </span>
        </div><h1 style="color:green; font-size: 60px;">Your verification code is : ' . $code . '</h1>';
        $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo "Decline Email Sending Failed";
        }else{
            echo "success";
        }

} else {
    echo "This Category exists";
}

?>