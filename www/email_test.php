<?php
use PHPMailer\PHPMailer\PHPMailer;   // using namespace
use PHPMailer\PHPMailer\Exception;

require_once '../lib/PHPMailer/src/Exception.php';
require_once '../lib/PHPMailer/src/PHPMailer.php';
require_once '../lib/PHPMailer/src/SMTP.php';

include "ini/gmail.php" ;
if( empty( $smtp ) ) {
    echo "Config error" ;
    exit ;
}

$mail = new PHPMailer( true ) ;
$mail->IsSMTP();                       // enable SMTP
$mail->SMTPDebug   = 1;                // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth    = true;             // authentication enabled
$mail->SMTPSecure  = $smtp['secure'];  // secure transfer enabled REQUIRED for Gmail
$mail->Host        = $smtp['host'];
$mail->Port        = $smtp['port'];
$mail->SMTPOptions = $smtp['options'];
$mail->Username    = $smtp['user'];
$mail->Password    = $smtp['pass'];

$mail->SetFrom( $smtp['user'] ) ;

$mail->IsHTML( true ) ;
$mail->Subject = "PHP site message from unicorn" ;
$mail->Body    = "Hello by unicorn";
$mail->AddAddress( include "ini/myEmail.php" ) ;
if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo ;
} else {
    echo "Message has been sent" ;
}
/*
Д.З. Настроить и Реализовать отправку почтовых сообщений по SMTP протоколу.
При регистрации пользователя формировать и отправлять письмо с кодом подтверждения почты (confirm)
** сохранять в БД статус отправки письма 
*/


/*
 include          подключить (и выполнить) файл. Если файла нет - warning и идем дальше
 include_once     то же самое, но + проверка не был ли файл подключен ранее
 require          то же самое, но если файла нет - фатальная ошибка (работа останавливается)
 require_once

 @include_once "TheClass.php" ;
 if( ! class_exists( "TheClass" ) ) ... местная обработка ошибки
*/
