<?php
namespace Mmshightech\interfaceLet;
use Classes\response\Response;

interface IDataGenerator
{
    public function getTransactionData(string $transactionType);
}
?>