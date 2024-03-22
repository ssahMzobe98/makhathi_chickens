<?php

namespace Mmshightech\service\factory\HttpRequest;

use Mmshightech\interfaceLet\IDaoFactory;
use App\Http\HTTPConstants\HTTPConstants;
use App\Http\Controllers\HTTPRequests\HTTPRequests;
class HttpRequestFactory implements IDaoFactory
{
    public static array $data=[
        HTTPConstants::HTTP_REQUEST=>HTTPRequests::class
    ];
    public static function make(string $daoClass, array $array)
    {
        $class=self::$data[HTTPConstants::HTTP_REQUEST];
        if(!empty(self::$data[$daoClass])){
            $class=self::$data[$daoClass];
        }
        return new $class(...$array);
    }
}
