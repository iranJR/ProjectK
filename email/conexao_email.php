<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 08/01/2019
 * Time: 15:29
 */

require_once ("../email/config_email.inc.php");

/* Extender a classe do phpmailer para envio do email*/
use PHPMailer\PHPMailer\PHPMailer;
require_once ("../vendor/autoload.php");

// Instanciando a classe e adiconando a codificação UTF-8.
$email = new PHPMailer();
$email->CharSet = 'UTF-8';

// Protocolo para o envio de e-mails.
$email->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$email->SMTPDebug = 2;

// Configurações do GMAIL.
$email->Host = 'smtp.gmail.com';
$email->Port = 587;
$email->SMTPSecure = 'tls';
$email->SMTPAuth = true;

// E-mail do remetente.
$email->Username = GUSER;
// Senha do remetente.
$email->Password = GPWD;