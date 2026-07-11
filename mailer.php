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

    $confirm_link = "http://localhost/Satifia/confirm.php?token=" . $token;
}
?>