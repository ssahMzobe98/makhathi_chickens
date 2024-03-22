<?php
include "../vendor/autoload.php";
$e="UNKNOWN REQUEST!!";

use Src\constants\StatusConstants;
use Src\constants\ServiceConstants;
use Mmshightech\service\factory\DataGeneratorFactory;
use Classes\logs\WriteResponseLog;
use App\Http\HTTPConstants\HTTPConstants;
use Mmshightech\service\factory\HttpRequest\HttpRequestFactory;
$Http =  HttpRequestFactory::make(HTTPConstants::HTTP_REQUEST,[]);
$data = $Http->getHttpData();
$login = DataGeneratorFactory::make(ServiceConstants::WEB_AUTH,[null]);
try{
    if(isset($data['emailLogin'],$data['passLogin'],$data['dash'])){
        $emailLogin=$login->cleanDataSet($data['emailLogin']);
        $passLogin=$login->cleanDataSet($data['passLogin']);
        $dash = $login->cleanDataSet($data['dash']);
        $dash=($dash=="app")?$dash:'dash';
        $e = $login->loginRequestAccess($emailLogin,$passLogin,$dash);
        if($e->responseStatus==StatusConstants::SUCCESS_STATUS){
            session_start();
            $_SESSION['user_agent'] = $emailLogin;
            $_SESSION['var_agent'] = $login->lockPassWord($emailLogin.$login->lockPassWord($passLogin));
            $simple_string =$emailLogin."-".$passLogin;
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $encryption_iv = '0685153023980510';
            $encryption_key = "MaKhathiChickens";
            $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
            $arr_cookie_options = array (
                'expires' => time() + 60*60*24*30,
                'path' => '/',
                'domain' => '.localhost/makhathichickens/'.$dash,
                'secure' => true,
                'httponly' => true,
                'samesite' => 'None'
            );
            setcookie("umfazi", $login->lockPassWord($login->lockPassWord($emailLogin.$login->lockPassWord($passLogin))),$arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
            setcookie("indoda",$login->lockPassWord($login->lockPassWord("nnjvgftgdb sdf@jhbds").$login->lockPassWord(md5("jkndfsd @nkdndsfsdf"))), $arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
            setcookie("hlomula",$login->lockPassWord($login->lockPassWord(md5("123456fgdfgdf")).$login->lockPassWord(md5("123fd123"))), $arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
            setcookie("ibhubesi","$encryption", $arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
            
        }
    }
    elseif (isset($data['email'],$data['pass'],$data['name'],$data['phone'])){
        $email=$login->cleanDataSet($data['email']);
        $pass=$login->cleanDataSet($data['pass']);
        $name=$login->cleanDataSet($data['name']);
        $phone=$login->cleanDataSet($data['phone']);

        $e = $login->createNewUserFromApp($email,$pass,$name,$phone);
    }
    elseif (isset($data['verification_Code'],$data['emailAddress'])){
        $verification_Code=$login->cleanDataSet($data['verification_Code']);
        $emailAddress=$login->cleanDataSet($data['emailAddress']);

        $e = $login->verifyNewAccount($verification_Code,$emailAddress);
    }
}
catch (\Exception $m) {
   $erroObject= WriteResponseLog::exceptionBuiler($m);
   $e->responseStatus = Flags::FAILED_STATUS;
   $e->responseMessage = $m->getMessage();
   WriteResponseLog::writelogResponse('../storage/logs/', $erroObject->issueType, $erroObject->class, $erroObject->method, $erroObject);
}
echo json_encode($e);
?>
