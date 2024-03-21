<?php
include "../vendor/autoload.php";
$e="UNKNOWN REQUEST!!";

use Src\constants\StatusConstants;
use Src\constants\ServiceConstants;
use Mmshightech\service\factory\DataGeneratorFactory;

// $login=new LoginProcessor(null);
$login = DataGeneratorFactory::make(ServiceConstants::WEB_AUTH,[null]);
if(isset($_POST['emailLogin'],$_POST['passLogin'],$_POST['dash'])){
    $emailLogin=$login->cleanDataSet($_POST['emailLogin']);
    $passLogin=$login->cleanDataSet($_POST['passLogin']);
    $dash = $login->cleanDataSet($_POST['dash']);
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
        $e=1;
    }
    else{
        $e=$e->responseMessage;
    }
}
elseif (isset($_POST['email'],$_POST['pass'],$_POST['name'],$_POST['phone'])){
    $email=$login->cleanDataSet($_POST['email']);
    $pass=$login->cleanDataSet($_POST['pass']);
    $name=$login->cleanDataSet($_POST['name']);
    $phone=$login->cleanDataSet($_POST['phone']);

    $e = $login->createNewUserFromApp($email,$pass,$name,$phone);
    if($e->responseStatus==StatusConstants::SUCCESS_STATUS){
        $e=1;
    }
    else{
        $e=$e->responseMessage;
    }
}
elseif (isset($_POST['verification_Code'],$_POST['emailAddress'])){
    $verification_Code=$login->cleanDataSet($_POST['verification_Code']);
    $emailAddress=$login->cleanDataSet($_POST['emailAddress']);

    $e = $login->verifyNewAccount($verification_Code,$emailAddress);
    if($e->responseStatus==StatusConstants::SUCCESS_STATUS){
        $e=1;
    }
    else{
        $e=$e->responseMessage;
    }
}
echo json_encode($e);
?>
