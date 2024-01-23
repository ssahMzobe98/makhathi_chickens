<?php

namespace Mmshightech\service\factory\daoFactory;

use Classes\dao\userDao;
use Classes\dao\transactionDao;
use Classes\dao\productDao;
use Mmshightech\interfaceLet\IDaoFactory;
use Src\constants\DaoClassConstants;

class DaoFactory implements IDaoFactory
{
    public static array $data=[
        DaoClassConstants::USER_DAO=>userDao::class,
        DaoClassConstants::TRANSACTION_DAO=>transactionDao::class,
        DaoClassConstants::PRODUCTS=>productDao::class
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
