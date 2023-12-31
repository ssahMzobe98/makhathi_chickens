<?php

namespace Mmshightech\service\factory\daoFactory;

use Classes\dao\userDao;
use Mmshightech\interfaceLet\IDaoFactory;
use Src\constants\DaoClassConstants;

class DaoFactory implements IDaoFactory
{
    public static array $data=[
        DaoClassConstants::USER_DAO=>userDao::class
    ];
    public static function make(string $daoClass, array $array)
    {
        $class=self::$data[DaoClassConstants::USER_DAO];
        if(!empty(self::$data[$daoClass])){
            $class=self::$data[$daoClass];
        }
        return new $class(...$array);
    }
}
