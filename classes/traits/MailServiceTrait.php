<?php

namespace Classes\traits;

use Mmshightech\service\factory\mailservice\MailServiceFactory;
use Mmshightech\service\mail\MailService;
use Src\constants\ServiceConstants;
use PHPMailer\PHPMailer\PHPMailer;

trait MailServiceTrait
{
    public $mailservice;
    public function init(){
        $this->mailservice=mailserviceMailServiceFactory::make(ServiceConstants::MAIL_SERVICE,[new PHPMailer()]);
    }
}
