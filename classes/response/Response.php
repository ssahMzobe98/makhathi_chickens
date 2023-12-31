<?php

namespace Classes\response;

use Src\constants\StatusConstants;

class Response
{
    public string $responseStatus='';
    public string $responseMessage='';
    public array $responseArray=[];
    public $response;
    public  function successSetter():Response{
        $this->responseStatus = StatusConstants::SUCCESS_STATUS;
        return $this;
    }
    public  function failureSetter():Response{
        $this->responseStatus = StatusConstants::FAILED_STATUS;
        return $this;
    }
    public  function messagerSetter(String $message=""):Response{
        $this->responseMessage = $message;
        return $this;
    }
    public  function messagerArraySetter(array $arrayMesssage=[]):Response{
        $this->responseArray = $arrayMesssage;
        return $this;
    }
    public function setObjectReturn():Response{
        $this->response = (object) ["responseStatus"=>$this->responseStatus,"responseMessage"=>$this->responseMessage,
            "responseArray"=>$this->responseArray];
        return $this;
    }
}
