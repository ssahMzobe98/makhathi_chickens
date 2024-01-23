<?php

namespace Classes\dao;

use Classes\DBConnect\DBConnect;
use Classes\response\Response;
use Mmshightech\mmshightech;
use Mmshightech\service\CleanData;
use Classes\traits\DBConnectTrait;
use Src\constants\StatusConstants;
use Src\constants\Flags;
class userDao extends CleanData
{
    use DBConnectTrait;
    public function getCurrentUserByEmail(?string $userMail):array{
        $sql = "select * from makhathi_chickens_users where email=?";
        return $this->connect->getAllDataSafely($sql,'s',[$userMail])[0]??[];
    }
    public function getCreditHistoryUserUId(?int $userId):array{
        $sql = "select id from makhathi_chickens_users where id=?";
        return $this->connect->getAllDataSafely($sql,'s',[$userId])[0]??[];
        
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
    public function getAllAppUsers():array{
        $sql="select mcu.name_surname as name,
                mcu.phone as phone,
                mcu.email as email,
                da.address as address,
                mcu.id as user_id,
                cu.amount as amount,
                cu.tax as tax,
                concat('2000.00') as credit_max_amount,
                cu.interest as interest,
                mcu.is_credit_ready as is_credit_ready, 
                (
                    select sum(amount) from credit_history where action_type='CREDIT'
                ) as credit_history_credit,
                (
                    select sum(amount) from credit_history where action_type='PAYMENT'
                ) as credit_history_payment
              from makhathi_chickens_users as mcu
                left join delivery_address as da on da.id=mcu.delivery_address_id and da.status='A'
                left join credits_users as cu on cu.user_id=da.id
              where mcu.added_by=?
            ";
        return $this->connect->getAllDataSafely($sql,'s',[Flags::USER_SYSTEM_TYPE])??[];
    }
    public function getCreditHistory(?int $userID):array{
        $sql="select 
                    ch.amount,
                    ch.user_id,
                    ch.action_type,
                    ch.transaction_day 
              from credit_history as ch
                left join credits_users as cu on cu.user_id=ch.user_id
              where ch.user_id=? and cu.payment_status='OPEN' order by ch.id DESC";
        return $this->connect->getAllDataSafely($sql,'s',[$userID])??[];
    }
    public function getCreditPayableAmount(?int $userID):array{
        $sql = "select amount,amount_with_interest,repayment_amount,payment_status from credits_users where user_id=? and payment_status='OPEN'";
        return $this->connect->getAllDataSafely($sql,'s',[$userID])[0]??[];
    }
}
