<?php

namespace Mmshightech\interfaceLet;
use PHPMailer\PHPMailer\PHPMailer;
use Classes\response\Response;
use Mmshightech\service\mail\MailService;

interface IMailServiceImplemtation
{
    public function setSMTPSettings($host, $username, $password, $port = 465, $encryption = PHPMailer::ENCRYPTION_SMTPS):MailService;

    public function setSender($email, $name):MailService;

    public function addRecipient($email, string $name=''):MailService;

    public function setSubject($subject):MailService;

    public function setBody($body):MailService;

    public function send():Response;
}
