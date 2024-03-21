<?php

namespace Classes;

use Classes\response\Response;
use Classes\traits\DBConnectTrait;
use Classes\traits\MailServiceTrait;
use Mmshightech\service\CleanData;
use Mmshightech\service\mail\MailService;
use Src\constants\ServiceConstants;
use Src\constants\StatusConstants;

class LoginProcessor extends CleanData
{
    use DBConnectTrait;
    use MailServiceTrait;
    public function cleanDataSet(string $data=""):string{
        return $this->OMO($data);
    }
    public function cleanDataAll(array $data=[]):array{
        return $this->cleanAll($data);
    }
    public function loginRequestAccess(string $emailLogin="", string $passLogin="",string $dash=""):Response
    {
        return $this->login2App($emailLogin,$passLogin,$dash);
    }
    public function createNewUserFromApp(string $email="", string $pass="", string $name="", string $phone="",string $user_type='app'):Response
    {
        try{

        }
        catch(\Exception $e){
            WriteResponseLog::logResponse(ExceptionHelper::parseToStr($e),)
        }
        $response = $this->isAccountEmailSet($email);
        if($response->responseStatus!==StatusConstants::SUCCESS_STATUS){
            return $response;
        }
        $pass = $this->lockPassWord($pass);
        $sql="insert into makhathi_chickens_users(name_surname,phone,email,password,time_added,device_details,user_type)values(?,?,?,?,NOW(),?,?)";
        $params = [$name,$phone,$email,$pass,json_encode(['set'=>'array']),$user_type];
        $results= $this->connect->postDataSafely($sql,'ssssss',$params);
        if($results->responseStatus==StatusConstants::FAILED_STATUS){
            return $results;
        }
        return $this->generateVerificationCode(intval($results->responseMessage),$email);
    }
    public function createNewProduct(string $productTitle="",string $productProductType="",string $productSubTitle="",string $productSize="",string $productPrice="",string $productInstock="",string $productDescription="",int $userId=0):Response{
        $response = new Response();
        if(!$userId){
            $response->failureSetter()->messagerSetter("userId NOT provided!!")->setObjectReturn();
            return $response;
        }
        

    }
    public function verifyNewAccount(string $verification_Code="", string $emailAddress=""):Response
    {
        $response = new Response();
        $sql = "select * from verification_code where code = ? and email=? ";
        $return = $this->connect->numRows($sql,'ss',[$verification_Code,$emailAddress])??0;
        $response = $response->failureSetter()->messagerSetter("Verification Account Not found!!.")->setObjectReturn();
        if($return!==1){
            return $response;
        }
        $sql="update makhathi_chickens_users set is_activated=? where email=?";
        $response = $this->connect->postDataSafely($sql,'ss',['Y',$emailAddress]);
        if($response->responseStatus==StatusConstants::FAILED_STATUS){
            return $response;
        }
        $sql="update verification_code set code=0 where code=?";
        return $this->connect->postDataSafely($sql,'s',[$verification_Code]);
    }
    public function generateVerificationCode(?int $id,?string $email):Response
    {
        $rand1=rand(0,1);
        $code = rand(100,999);
        $results = $this->connect->postDataSafely(
            "insert into verification_code(user_id,email,date_time)values(?,?,NOW())",
            "ss",[$id,$email]);
        if($results->responseStatus==StatusConstants::FAILED_STATUS){
            $this->connect->connection->rollBack();
            return $results;
        }
        $codeId=intval($results->responseMessage)??-1;
        if($codeId<1){
            $results->failureSetter()->messagerSetter("Technical Error!!, Please contact support to report issue: 0685153023(WhatsApp")->messagerArraySetter([
               "Line "=>__LINE__,"Function"=>__FUNCTION__,"Issue"=>"Code ($code) is set to be -1. Must be greater than 0 for user $id. This may be due to being saved incorrectly or code issues."
            ]);
        }
        if($rand1==1){
            $code=$code.$codeId;
        }
        else{
            $code=$codeId.$code;
        }
        $results = $this->connect->postDataSafely(
            "update verification_code set code=? where user_id=?",
            "ss",[$code,$id]);
        if($results->responseStatus==StatusConstants::FAILED_STATUS){
            return $results;
        }
        $mailObject=(object)[
            "to"=>$email,
            "from"=>"noreply@makhathichickens.com",
            "message"=>"<p>Thank you for joining Thousands of our healthy customers. To be able to proceed to your account and start shopping now, Please find the attached verification code.</p>
                        <p>This code is yours!. Please use it withing 30 minutes from received time. You can only use this once. </p>
                        <p><span style='color:white;font-family: Arial,serif;font-size: smaller;font-weight: bolder;'>CODE : $code</span></p>
                        <p>Thank you very much.</p>
                       ",
            "header"=>"header",
            "subject"=>"subject"
        ];
        return $this->mailservice->setSMTPSettings(StatusConstants::MAIL_HOST, StatusConstants::DEFAULT_SYSTEM_SENDER, StatusConstants::MAILER_PASS, 465,PHPMailer::ENCRYPTION_SMTPS)
                        ->setSender(StatusConstants::DEFAULT_SYSTEM_SENDER,StatusConstants::DEFAULT_SYSTEM_SENDER_NAME)
                        ->addRecipient($mailObject->email,'')
                        ->setSubject($mailObject->subject)
                        ->setBody($mailObject->message)
                        ->send();
    }
}
