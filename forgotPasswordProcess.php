<?php

require "connection.php";

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {
    $e = $_GET["e"];

    if (empty($e)) {
        echo "Please enter your email address";
    } else {

        $rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $e . "' ");

        if ($rs->num_rows == 1) {

            $code = uniqid();

            Database::iud("UPDATE `users` SET `verification_code`='" . $code . "' WHERE `email`='" . $e . "';");

            //email code

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com'; // gmail acc ekkin dnwnm oya thiyen ek nttn methanata gnn host ek hri domain ek hri denn
            $mail->SMTPAuth = true;
            $mail->Username = 'dilrangalakshan890@gmail.com'; // ywn gmail acc eke username ek server eken dena username ek
            $mail->Password = 'Dil*&^98'; // ywn gmail acc eke password server eke password ek
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('dilrangalakshan890@gmail.com', 'eShop');
            $mail->addReplyTo('dilrangalakshan890@gmail.comom', 'eShop');
            $mail->addAddress($e); // yawana ona kenage address ek
            $mail->isHTML(true);
            $mail->Subject = 'eShop Forgot Password Verification Code';
            $bodyContent = 'eShop Forgot Password Verification Code';
            $bodyContent .= '<h1 style="color:red";>Your Verification Code : '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending fail';
            } else {
                echo 'Success';
            }

            //email code

        } else {
            echo "Email address not found";
        }
    }
} else {
    echo "Please enter your email address";
}


