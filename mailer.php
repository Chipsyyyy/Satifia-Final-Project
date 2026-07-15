<?php

require("phpmailer/src/PHPMailer.php");
require("phpmailer/src/SMTP.php");
require("phpmailer/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_confirmation_email($to_email, $to_name, $token) {

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "samnieves1206@gmail.com";
    $mail->Password   = "syla ljqy vvap bwbx";
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;

    $mail->setFrom("no-reply@satifia.com", "Satifia");
    $mail->addAddress($to_email, $to_name);

    $confirm_link = "https://satifia.freehosting.dev/confirm.php?token=" . $token;

    $mail->isHTML(true);
    $mail->Subject = "Confirm your Satifia account";
    $mail->Body = "
        <div style='font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto;'>
            <h2 style='color: #1A1A1A; letter-spacing: 2px;'>SATIFIA</h2>
            <p>Dear <strong>$to_name</strong>,</p>
            <p>Thank you for registering at Satifia! Please confirm your email address by clicking the button below:</p>
            <p style='text-align: center; margin: 30px 0;'>
                <a href='$confirm_link'
                   style='background-color: #1A1A1A; color: white; padding: 14px 32px; text-decoration: none; font-size: 13px; letter-spacing: 2px; text-transform: uppercase;'>
                    Confirm Account
                </a>
            </p>
            <p>If the button does not work, copy and paste this link to your browser:</p>
            <p><a href='$confirm_link'>$confirm_link</a></p>
            <br>
            <p style='font-size: 12px; color: #999;'>This is an automated message from Satifia. Please do not reply.</p>
        </div>
    ";

    $mail->send();
}
?>