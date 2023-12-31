<?php

namespace Mmshightech\interfaceLet;

use Classes\response\Response;

interface IMailServiceImplemtation
{
    public function sendMail(?object $mailObject):Response;
}
