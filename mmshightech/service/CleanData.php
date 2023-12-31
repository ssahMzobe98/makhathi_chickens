<?php

namespace Mmshightech\service;

use Classes\response\Response;
use Classes\traits\DBConnectTrait;
use Mmshightech\interfaceLet\ICleanData;
use Src\constants\StatusConstants;

class CleanData implements ICleanData
{
    use DBConnectTrait;
    protected function cleanData(string $mess){
        $mess = str_replace('<', "?", $mess);
        $mess = str_replace('>', "?", $mess);
        $mess = str_replace("\\r\\n", "<br>", $mess);
        $mess = str_replace("\\n\\r", "<br>", $mess);
        $mess = str_replace("\\r", "<br>", $mess);
        $mess = str_replace("\\n", "<br>", $mess);
        $mess = str_replace("\r\n", "<br>", $mess);
        $mess = str_replace("\n\r", "<br>", $mess);
        $mess = str_replace("\r", "<br>", $mess);
        $mess = str_replace("\n", "<br>", $mess);
        $mess = str_replace("\\", " ", $mess);
        $mess = str_replace("'", "`", $mess);
        $mess = str_replace('"', "``", $mess);
        return $mess;
    }
    public function OMO(string $string){
        return $this->cleanData(
            mysqli_escape_string(
                $this->connect->connection,$string
            )
        );
    }
    public function cleanAll(array $data =[]){
        if(empty($data)){
            return array();
        }
        $cleanData = [];
        foreach ($data as $da){
            $cleanData[] = $this->cleanData(
                mysqli_escape_string(
                    $this->connect->connection,$da));
        }
        return  $cleanData;
    }
    public function login(string $email=null,string $pass=null,string $app='app'):array{
        $pass = $this->lockPassWord($pass);
        // echo $pass." | ".$email;
        $response = $this->Verification($email,$pass,$app);
        if($response==1){
            return ['response'=>'S','data'=>'Success'];
        }
        return ['response'=>'F','data'=>'Email|Password incorrect'];
    }
    public function login2App(string $email=null, string $pass=null,string $app="app"):Response{
        $response = new Response();
        $pass = $this->lockPassWord($pass);
        $intRespo = $this->VerificationApp($email,$pass,$app);
        $response->failureSetter()->messagerSetter('incorrect email|password!')->setObjectReturn();
        if($intRespo==1){
            $response->successSetter()->messagerSetter(StatusConstants::SUCCESS_MESSAGE)->setObjectReturn();
        }
        return $response;
    }
    private function Verification($email,$pass,$app):int{
        return $this->VerificationApp($email,$pass,$app);
    }
    private function VerificationApp($email,$pass,$app):int{
        $sql = "select email,password,user_type from makhathi_chickens_users where email=? and password=? and user_type=?";
        return $this->connect->numRows($sql,"sss",[$email,$pass,$app])??0;
    }
    public function lockPassWord(string $pass):string{
        return $this->ibhubesiLesilisa(
            md5(
                $this->ibhubesiLesilisa(
                    md5(
                        $this->ibhubesiLesilisa($pass)
                    )
                )
            )
        );
    }
    public function verifyClientMenuStore(array $cleanData=[]):array{
        if(empty($cleanData)){
            return ['response'=>"F",'data'=>"Failed to process empty dataset."];
        }
        $verifiedData = [];
        foreach ($cleanData as $data){
            if(empty($data)){
                $verifiedData=['response'=>"F",'data'=>"Failed to process empty dataset. You have an undefined var dataset"];
                break;
            }
            else{
                $verifiedData[]=$this->$data;
            }
        }
        return $verifiedData;
    }
    private function ibhubesiLesilisa($pwd){
        $strArr=array("L","9","D","!","a","K","1","b","Y","$","R","c","@","F","d","S","3","e","5","-","A","f","g","6","V","h","G","i","W","j","k","l","T","%","m","8","B","n","E","+","o","X","p","C","*","q","r","Q","s","M","+","t","N","2","u","H","v","4","U","w","I","7","&","x","O","y","J","z","=","P");
        $intArr=array('!','1','B','$','9','T','%','3','^','5','*','2','6','Y','(','7','+','8','G','-','4','E');
        //print sizeof($strArr)."   ";
        $fihliwe=$this->shayIqanda($this->wamaHalahle($pwd),$strArr);
        return $fihliwe;
    }
    private function shayIqanda($iqanda,$arr){
        $bhozo=str_split($iqanda);
        $khala="";
        foreach ($bhozo as $value) {
            $inamba=ord($value);
            //print $value;
            //print $inamba."-";
            $currPos=$this->position($this->hash1($inamba));
            $khala.=$arr[$currPos];
            //echo "<pre>";print $arr[$currPos];echo"<prev";
        }
        return $khala;
    }
    private function hash1($inamba){
        $hi=(($inamba^3)*((8%$inamba)/0.5))/30;
        //print $hi."  ";
        return $hi;
    }
    private function position($pos){
        ///print_r($strArr);
        if($pos>69){
            $pos/=3;
            return $pos;

        }
        else{
            return $pos;
        }
    }
    public function userInfo(string $agent=null):array{
        return $this->connect->getAllDataSafely("select*from users where usermail=?","s",[$agent])[0]??[];
    }
    public function updateDomeBackground(int $dome=0,int $id=0):array{
        $sql = "update users set background=? where id=?";
        $response = $this->connect->postDataSafely($sql,'ss',[$dome,$id]);
        if(is_numeric($response)&&$response==$id){
            return ['response'=>"S",'data'=>"Success"];
        }
        else{
            return ['response'=>"F",'data'=>$response];
        }
    }
    private function wamaHalahle($pwd){
        $umphumela=str_split($pwd);
        $ubhozo="fr%";$ucikicane="fRg";$isithupha="3g@";
        $k=0;
        $uzwane="";
        foreach ($umphumela as $value) {
            if($k<sizeof($umphumela)){
                if((sizeof($umphumela)%2)==0){
                    if(($k)==2){
                        $uzwane=$uzwane.$ubhozo;
                        //print $uzwane."";
                    }
                    else if(($k)==6){
                        $uzwane=$uzwane.$ucikicane;
                    }
                    else if(($k)==9){
                        $uzwane=$uzwane.$isithupha;
                    }
                    else{
                        $uzwane=$uzwane.$value;
                    }
                }
                else{
                    if(($k)==3){
                        $uzwane=$uzwane.$ubhozo;
                        //print $uzwane."";
                    }
                    else if(($k)==7){
                        $uzwane=$uzwane.$ucikicane;
                    }
                    else if(($k)==10){
                        $uzwane=$uzwane.$isithupha;
                    }
                    else{
                        $uzwane=$uzwane.$value;
                    }
                }
            }
            else{
                break;
            }
            $k+=1;
        }
        return $uzwane;
    }
}
