<?php

require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";
// require "POP3.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["e"])) {

    $e = $_POST["e"];

    if (empty($e)) {
        echo "Please enter your Email address";
    } else {

        $adminrs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $e . "' ");
        $an = $adminrs->num_rows;

        if ($an == 1) {

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification`= '" . $code . "' WHERE `email` = '" . $e . "' ");

            // email code

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com'; // gmail acc ekkin dnwnm oya thiyen ek nttn methanata gnn host ek hri domain ek hri denn
            $mail->SMTPAuth = true;
            $mail->Username = 'dilrangalakshan890@gmail.com'; // ywn gmail acc eke username ek server eken dena username ek
            $mail->Password = 'Dil*&^98'; // ywn gmail acc eke password server eke password ek
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('dilrangalakshan890@gmail.com', 'eShop');
            $mail->addReplyTo('dilrangalakshan890@gmail.com', 'eShop');
            $mail->addAddress($e); // yawana ona kenage address ek
            $mail->isHTML(true);
            $mail->Subject = 'eShop Admin Verification Code';
            $bodyContent = 'eShop Admin Verification Code';
            $bodyContent .= '<h3 style="color:black";>Your Verification Code : ' . $code . '</h3>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending fail';
            } else {
                echo 'Success';
            }

            // email code

        } else {
            echo "You are not valid user";
        }
    }
} else {
    echo "Please enter your Email address";
}
