<?php

namespace Classes;

use Classes\traits\DBConnectTrait;

class LoginSessionScanning
{
    use DBConnectTrait;
    public function isActiveSessions():array{
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        if(!isset($_COOKIE)){
            session_destroy();
            return [];
        }
//        setcookie("umfazi", $mmshightech->lockPassWord($mmshightech->lockPassWord($_POST['email']) . $mmshightech->lockPassWord($_POST['pass'])), $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
//        setcookie("indoda", $mmshightech->lockPassWord($mmshightech->lockPassWord("nnjvgftgdb sdf@jhbds") . $mmshightech->lockPassWord(md5("jkndfsd @nkdndsfsdf"))), $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
//        setcookie("hlomula", $mmshightech->lockPassWord($mmshightech->lockPassWord(md5("123456fgdfgdf")) . $mmshightech->lockPassWord(md5("123fd123"))), $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
//        setcookie("ibhubesi", $encryption, $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
        if(isset($_COOKIE['umfazi'],$_COOKIE['indoda'],$_COOKIE['hlomula'],$_COOKIE['ibhubesi'])){
            return $_COOKIE;
        }
        return [];
    }
}
