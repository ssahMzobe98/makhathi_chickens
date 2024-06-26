<?php

namespace Mmshightech\service\factory;

use Mmshightech\interfaceLet\IMailService;
use Mmshightech\mmshightech;
use Src\constants\ServiceConstants;
use Classes\response\Response;

class MmsServiceFactory
{
    protected static $data = [
        ServiceConstants::MMSHIGHTECH => mmshightech::class,
        ServiceConstants::RESPONSE=>Response::class
    ];
    public static function make(string $MMSHIGHTECH, array $array)
    {
        $cl = self::$data[ServiceConstants::MMSHIGHTECH];
        if (!empty(self::$data[$MMSHIGHTECH])) {
            $cl =  self::$data[$MMSHIGHTECH];
        }
        return new $cl(...$array);
    }
}
