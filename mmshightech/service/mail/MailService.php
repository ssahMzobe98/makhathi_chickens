<?php

namespace Mmshightech\service\mail;

use Classes\response\Response;
use Mmshightech\interfaceLet\IMailServiceImplemtation;
use Src\constants\StatusConstants;

class MailService implements IMailServiceImplemtation
{
    /**
     * @param string|null $DBConnected
     */
    public function __construct(?string $DBConnected)
    {
        $this->DBConnected = $DBConnected;
    }
    public function sendMail(?object $mailObject):Response{
        $response = new Response();
        $to=$mailObject->to;
        $from = $mailObject->from;
        $message = $mailObject->message;
        $header = $mailObject->header;
        $subject = $mailObject->subject;
        $mailResponse =1;//= mail($to,$subject,$message,[$header],[$from]);
        $response->responseStatus=StatusConstants::FAILED_STATUS;
        $response->responseMessage='Failed to send Mail due to : '.json_encode($mailResponse);
        if($mailResponse){
            $response->responseStatus=StatusConstants::SUCCESS_STATUS;
            $response->responseMessage='Sent';
        }
        return $response;
    }
}
