<?php

namespace Classes\traits;

use Mmshightech\mmshightech;
use Mmshightech\service\factory\MmsServiceFactory;
use Src\constants\ServiceConstants;
use Src\constants\StatusConstants;
use Mmshightech\service\factory\DataGeneratorFactory;
use classes\generator\DataGenerator;
use Classes\response\Response;
trait DBConnectTrait
{
    public mmshightech $connect;
    public DataGenerator $dataGenerator;
    public $Response;
    public function __construct(mmshightech|null $makeConnection)
    {
        if(!isset($makeConnection)){
            $makeConnection = MmsServiceFactory::make(ServiceConstants::MMSHIGHTECH,[StatusConstants::CONNECTION_STATUS_NOT_CONNECTED]);
        }
        $this->connect =$makeConnection;
        $this->dataGenerator = DataGeneratorFactory::make(ServiceConstants::GENERATE_DATA,[$this->connect]);
        $this->Response = MmsServiceFactory::make(ServiceConstants::RESPONSE,[]);
    }

}
