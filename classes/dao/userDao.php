<?php

namespace Classes\dao;

use Classes\DBConnect\DBConnect;
use Classes\response\Response;
use Mmshightech\mmshightech;
use Mmshightech\service\CleanData;
use Classes\traits\DBConnectTrait;
use Src\constants\StatusConstants;
class userDao extends CleanData
{
    use DBConnectTrait;
    public function getCurrentUserByEmail(?string $userMail):array{
        $sql = "select * from makhathi_chickens_users where email=?";
        return $this->connect->getAllDataSafely($sql,'s',[$userMail])[0]??[];
    }
    public function getUserUidsAndNames(?int $excludedId=0):array{
        if(!$excludedId){
            return [];
        }
        $sql="select id as user_id, name_surname as name from makhathi_chickens_users where id!=?";
        return $this->connect->getAllDataSafely($sql,'s',[$excludedId])??[];
    }
    public function createNewAdminUser(string $fname="",string $userPhoneNo="",string $userEmailAddress="",string $userPassword="",string $gender="",int $userCreaterId=0):Response{
        $response = new Response();
        if(!$userCreaterId){
            $response->failureSetter()->messagerSetter("userId NOT provided!!")->setObjectReturn();
            return $response;
        }
        $response = $this->isAccountEmailSet($userEmailAddress);
        if($response->responseStatus!==StatusConstants::SUCCESS_STATUS){
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
                                        user_type)values(?,?,?,?,?,?,'Y',NOW(),NOW(),'dash')";
        $params = [$fname,$gender,$userPhoneNo,$userEmailAddress,$userPassword,$userCreaterId];
        $results= $this->connect->postDataSafely($sql,'ssssss',$params);
        if($results->responseStatus==StatusConstants::FAILED_STATUS){
            $this->$connect->rollBack();
        }
        return $results;

    }
}
