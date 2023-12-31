<?php

namespace Classes\traits;

use Mmshightech\service\factory\mailservice\MailServiceFactory;
use Mmshightech\service\mail\MailService;
use Src\constants\ServiceConstants;

trait MailServiceTrait
{
    public function mailServiceConnector():MailService{

        return MailServiceFactory::make(ServiceConstants::MAIL_SERVICE,['DBConnected'=>'N']);
    }
}
