<?php

require "connection.php";
require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["em"])) {

    if (empty($_POST["em"])) {

        echo "Please Enter you Email Address";
    } else {

        $email = $_POST["em"];

        $adminrs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "' ");
        $admin_num = $adminrs->num_rows;

        if ($admin_num == 1) {

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `code`='" . $code . "' WHERE `email`='" . $email . "'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kanipunsanjaya14@gmail.com';
            $mail->Password = 'password';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('', 'eBike');
            $mail->addReplyTo('', 'eBike');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Admin Verification Code';
            $bodyContent = '<div style=" 
    width:100%;
    height: 250px;
    background-color: yellow;">
    <span style="color:red; font-size: 100px;">eBike</span><br><br>
    <span style="color:black; font-size: 25px;" >Please confirm that you want to use this as your eBike account email address. Once it is done, you can access it. </span>
    </div><h1 style="color:green; font-size: 60px;">Your verification code is : ' . $code . '</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'success';
            }
        } else {
            echo "You are not a valid user";
        }
    }
}
