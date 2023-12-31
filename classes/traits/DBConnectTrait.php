<?php

namespace Classes\traits;

use Mmshightech\mmshightech;
use Mmshightech\service\factory\MmsServiceFactory;
use Src\constants\ServiceConstants;
use Src\constants\StatusConstants;

trait DBConnectTrait
{
    public mmshightech $connect;
    public function __construct(mmshightech|null $makeConnection)
    {
        if(!isset($makeConnection)){
            $makeConnection = MmsServiceFactory::make(ServiceConstants::MMSHIGHTECH,[StatusConstants::CONNECTION_STATUS_NOT_CONNECTED]);

        }
        $this->connect =$makeConnection;
    }

}
