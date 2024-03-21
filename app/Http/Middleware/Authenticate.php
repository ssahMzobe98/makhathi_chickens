<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Classes\traits\DBConnectTrait;
use Classes\response\Response;
use Src\constants\Flags;

class Authenticate extends Middleware
{
    use DBConnectTrait;
    public function APILoginRequest():Response{
        /** TODO */
        $this->Response->responseStatus=Flags::FAILED_STATUS;
        $this->Response->responseMessage="No Messge";
        return $this->Response;
    }
    
}
