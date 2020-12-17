<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once "config.php";
require_once "vendor/autoload.php";

/*
Test code
$mail = initMailing();
$dest = [
    ["xxxxx@live.fr", "xxxxx"],
    ["xxxxx@gmail.com", "xxxxx"]
];
var_dump(mailing($mail, $dest, "Test", "<h1>Test</h1>", "Test"));
*/

function initMailing() {
    $mailer = new PHPMailer();
    $mailer->isSMTP();

    //$mailer->SMTPDebug = SMTP::DEBUG_OFF; //Production
    $mailer->SMTPDebug = SMTP::DEBUG_SERVER; //Dev

    // Mailing Server informations
    $mailer->Host = PHPMAILER_CFG['HOST'];
    $mailer->Port = PHPMAILER_CFG['PORT'];

    $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mailer->SMTPAuth = true;

    // Mailing account informations
    $mailer->Username = PHPMAILER_CFG['USER'];
    $mailer->Password = PHPMAILER_CFG['PASS'];

    // Preparing the e-mail
    $mailer->setFrom(PHPMAILER_CFG['USER'], "SITEC SECURITY");
    $mailer->addReplyTo(PHPMAILER_CFG['USER'], "SITEC SECURITY");

    return $mailer;
}

function mailing($mailer, $dest, string $subject, string $htmlMess, string $txtMess) {
    $result = false;

    if(is_array($dest[0])) {
        foreach($dest as $addr)
            $mailer->addAddress($addr[0], $addr[1]);
    } else
        $mailer->addAddress($dest[0], $dest[1]);

    $mailer->Subject = $subject;
    $mailer->msgHTML($htmlMess);
    $mailer->AltBody = $txtMess;

    if($mailer->send())
        $result = true;

    return $result;
}