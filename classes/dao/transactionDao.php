<?php

namespace Classes\dao;

use Classes\DBConnect\DBConnect;
use Classes\response\Response;
use Mmshightech\mmshightech;
use Mmshightech\service\CleanData;
use Classes\traits\DBConnectTrait;
use Src\constants\StatusConstants;
class transactionDao extends CleanData
{
    use DBConnectTrait;
    public function MakeTransaction(?string $transactReason="",?float $transactAmount=0.00,?int $transactPerson=0,?string $transactType="withdrawal",?int $permittedBy=0){
        $sql="insert into internal_transactions(reason,amount,transactor,permitted_by,type,action_time)values(?,?,?,?,?,NOW())";
        $params = [$transactReason,$transactAmount,$transactPerson,$permittedBy,$transactType];
        $results= $this->connect->postDataSafely($sql,'sssss',$params);
        if($results->responseStatus==StatusConstants::FAILED_STATUS){
            $this->$connect->rollBack();
        }
        return $results;
    }

}