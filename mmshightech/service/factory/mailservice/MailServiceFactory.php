<?php

namespace Mmshightech\service\factory\mailservice;

use Mmshightech\interfaceLet\IMailService;
use Mmshightech\service\mail\MailService;
use Src\constants\ServiceConstants;

class MailServiceFactory implements IMailService
{
    protected static array $data=[
        ServiceConstants::MAIL_SERVICE => MailService::class
    ];
    public static function make(string $mailService, array $array)
    {
        $cl=self::$data[ServiceConstants::MAIL_SERVICE];
        if(!empty($cl)){
            $cl=self::$data[$mailService];
        }
        return new $cl(...$array);
    }
}
