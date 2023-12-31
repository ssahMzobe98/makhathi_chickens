<?php

namespace Classes\dao;

use Classes\DBConnect\DBConnect;
use Mmshightech\mmshightech;

class userDao
{
    private mmshightech $dbConnect;
    public function __construct(mmshightech|null $dbConnect){
        if(empty($dbConnect)){
            $dbConnect = (new DBConnect(null))->getConnectionClass();
        }
        $this->dbConnect=$dbConnect;
    }
    public function getCurrentUserByEmail(?string $userMail):array{
        $sql = "select * from makhathi_chickens_users where email=?";
        return $this->dbConnect->getAllDataSafely($sql,'s',[$userMail])[0]??[];
    }
}
