<?php

namespace Classes\dao;

use Classes\DBConnect\DBConnect;
use Classes\response\Response;
use Mmshightech\mmshightech;
use Mmshightech\service\CleanData;

class userDao extends CleanData
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
    public function createNewAdminUser(string $fname="",string $userPhoneNo="",string $userEmailAddress="",string $userPassword="",string $gender="",int $userCreaterId=0):Response{
        $response = new Response();
        if(!$userCreaterId){
            $response->failureSetter()->messagerSetter("userId NOT provided!!")->setObjectReturn();
            return $response;
        }
        $response = $this->isAccountEmailSet($email);
        if($response->responseStatus==StatusConstants::SUCCESS_STATUS){
            return $response;
        }
        $userPassword = $this->lockPassWord($userPassword);
        $sql = "insert into makhathi_chickens_users(
                                        name_surname,
                                        gender,
                                        phone,
                                        email,
                                        password,
                                        added_by,
                                        is_activated,
                                        time_added,
                                        time_activated,
                                        user_type)values(?,?,?,?,?,?,'Y',NOW(),NOW(),'dash'";
        $params = [$fname,$gender,$userPhoneNo,$userEmailAddress,$userPassword,$userCreaterId];
        $results= $this->connect->postDataSafely($sql,'ssssss',$params);
        if($results->responseStatus==StatusConstants::FAILED_STATUS){
            $this->dbConnect->rollBack();
            return $results;
        }
        return $this->generateVerificationCode(intval($results->responseMessage),$email);

    }
}
