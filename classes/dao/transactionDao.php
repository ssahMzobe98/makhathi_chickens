<?php

namespace Classes\dao;

use Classes\DBConnect\DBConnect;
use Classes\response\Response;
use Mmshightech\mmshightech;
use Mmshightech\service\CleanData;
use Classes\traits\DBConnectTrait;
use Src\constants\StatusConstants;
use Src\constants\Flags;
class transactionDao extends CleanData
{
    use DBConnectTrait;
    public function MakeTransaction(?string $transactReason="",?string $transactAmount='0.00',?int $transactPerson=0,?string $transactType="withdrawal",?int $permittedBy=0):Response{
        $sql="insert into internal_transactions(reason,amount,transactor,permitted_by,type,action_time)values(?,?,?,?,?,NOW())";
        $params = [$transactReason,$transactAmount,$transactPerson,$permittedBy,$transactType];
        $results= $this->connect->postDataSafely($sql,'sssss',$params);
        if($results->responseStatus==StatusConstants::FAILED_STATUS){
            $this->$connect->rollBack();
        }
        return $results;
    }
    public function createTransactionStatement(null|string $transactionType=null):array{
        return $this->dataGenerator->getTransactionData($transactionType);
    }
    public function getTotalAmountOfTransaction(?string $deposit,?string $withdraw):array{
        return [Flags::TRANSACTION_TYPE_DEPOSIT=>$this->dataGenerator->getTotalAmountOfTransaction($deposit),Flags::TRANSACTION_TYPE_WITHDRAW=>$this->dataGenerator->getTotalAmountOfTransaction($withdraw)];
    }
    public function MakeCreditPaymentTransaction($re_payment_payableAmount,$re_payment_clientUserId,$re_payment_Payment,$systemUserId):Response{
        $response = new Response();
        if(!$this->dataGenerator->userOnCreditUsers($re_payment_clientUserId)){
            $response->failureSetter()->messagerSetter("Cannot Make payment. Client has no debt/credits.")->setObjectReturn();
            return $response;
        }
        $amountPaidForHistory=$re_payment_Payment;
        $amountOnCredit = $this->dataGenerator->getAmountOnCredit($re_payment_clientUserId);
        $amountDueByClientWithoutInterest = $amountOnCredit['amount']??0;
        $amountWithInterestDueByClient = $amountOnCredit['amount_with_interest']??0;
        $repayment_amount_by_client = $amountOnCredit['repayment_amount']??0;
        if($amountWithInterestDueByClient==0 || $amountWithInterestDueByClient<0){
            $response->failureSetter()->messagerSetter("Cannot Make payment. Client has no debt/credits: ({$amountWithInterestDueByClient})")->setObjectReturn();
            return $response;
        }
        $remaining_Amount=$amountWithInterestDueByClient-($repayment_amount_by_client+$re_payment_Payment);
        if($remaining_Amount<0){
            $response->failureSetter()->messagerSetter("Remaining Amount R{$amountWithInterestDueByClient} - {$re_payment_payableAmount} is < 0,There For cannot process this request")->setObjectReturn();
            return $response;
        }
        $re_payment_Payment+=$repayment_amount_by_client;
        $sql="update credits_users set repayment_amount=? ,actioned_on=NOW() where user_id=?";
        $params = [$re_payment_Payment,$re_payment_clientUserId];
        if($remaining_Amount==0 || $remaining_Amount<0){
            $sql="update credits_users set repayment_amount=?, payment_status='CLOSED' ,actioned_on=NOW() where user_id=?";
        }
        $response=$this->connect->postDataSafely($sql,'ss',$params);
        if($response->responseStatus===Flags::FAILED_STATUS){
            return $response;
        }
        $response = $this->addToCreditTransactionHistory([],$amountPaidForHistory,$re_payment_clientUserId,$systemUserId,'Payment');
        if($response->responseStatus===Flags::FAILED_STATUS){
            $this->connect->rollBack();
            return $response;
        }
        return $response;
    }
    private function updateCreditAmount($interestArrayData,$requestAmount,$clientUserId,$actioned_by):Response{
        $sql="update credits_users set amount=?,amount_with_interest=?,fee=?, interest=?,tax =?,actioned_by=?,actioned_on=NOW() where user_id=?";
        $params = [$requestAmount,$interestArrayData['amountWithInterest'],$interestArrayData['fee'],$interestArrayData['interest'],$interestArrayData['tax'],$actioned_by,$clientUserId];
        return $this->connect->postDataSafely($sql,'sssssss',$params);
    }
    private function addUserToCreditUsers($interestArrayData,$requestAmount,$clientUserId,$actioned_by,string $action_type=''):Response{
        $sql="insert into credits_users(user_id,amount,amount_with_interest,fee,interest,tax,actioned_by,actioned_on)values(?,?,?,?,?,?,?,now()) ";
        $params = [$clientUserId,$requestAmount,$interestArrayData['amountWithInterest'],$interestArrayData['fee'],$interestArrayData['interest'],$interestArrayData['tax'],$actioned_by,];
        return $this->connect->postDataSafely($sql,'sssssss',$params);
    }
    private function addToCreditTransactionHistory($interestArrayData,$requestAmount,$clientUserId,$systemUserId,$action_type = 'credit'):Response{
        $sql="insert into credit_history(user_id,amount,action_type,transactor,transaction_day)values(?,?,?,?,NOW())";
        return $this->connect->postDataSafely($sql,'ssss',[$clientUserId,$requestAmount,$action_type,$systemUserId]);
    }
    public function MakeCreditTransaction($requestAmount,$maxAmount,$clientUserId,$systemUserId):Response{
        $response = new Response();
        $response->failureSetter()->messagerSetter("User ID-{$clientUserId} NOT on credit Users. Please add user.")->setObjectReturn();
        $tax = $requestAmount*0.15;
        $fee = 5.00;
        $interest = $requestAmount*0.30;
        $amountWithInterest = $requestAmount+$tax+$fee+$interest;
        $originalAmountForHistory = $requestAmount;
        if($this->dataGenerator->userOnCreditUsers($clientUserId)){
            if($requestAmount>$maxAmount){
                $response->failureSetter()->messagerSetter("Credit Amount R{$requestAmount} Cannot be > {$maxAmount}")->setObjectReturn();
                return $response;
            }
            $amountOnCredit = $this->dataGenerator->getAmountOnCredit($clientUserId);
            $amountWithInterest += $amountOnCredit['amount_with_interest']??0;
            $requestAmount+=$amountOnCredit['amount']??0;
            $response=$this->updateCreditAmount(['amountWithInterest'=>$amountWithInterest,'tax'=>$tax,'fee'=>$fee,'interest'=>$interest],$requestAmount,$clientUserId,$systemUserId);
            if($response->responseStatus===Flags::FAILED_STATUS){
                return $response;
            }
            $response = $this->addToCreditTransactionHistory(['amountWithInterest'=>$amountWithInterest,'tax'=>$tax,'fee'=>$fee,'interest'=>$interest],$originalAmountForHistory,$clientUserId,$systemUserId);
            if($response->responseStatus===Flags::FAILED_STATUS){
                $this->connect->rollBack();
                return $response;
            }
            return $response;
        }
        $response = $this->addUserToCreditUsers(['amountWithInterest'=>$amountWithInterest,'tax'=>$tax,'fee'=>$fee,'interest'=>$interest],$requestAmount,$clientUserId,$systemUserId);
        if($response->responseStatus===Flags::FAILED_STATUS){
            return $response;
        }
        $response = $this->addToCreditTransactionHistory(['amountWithInterest'=>$amountWithInterest,'tax'=>$tax,'fee'=>$fee,'interest'=>$interest],$originalAmountForHistory,$clientUserId,$systemUserId);
        if($response->responseStatus===Flags::FAILED_STATUS){
            $this->connect->rollBack();
            return $response;
        }
        return $response;

    }
    
}