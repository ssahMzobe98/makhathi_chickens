<?php

use Classes\dao\userDao;
use Classes\DBConnect\DBConnect;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;
use Src\constants\Flags;
use App\Http\Controllers\HTTPRequests\HTTPRequests;
use App\Http\HTTPConstants\HTTPConstants;
use Mmshightech\service\factory\HttpRequest\HttpRequestFactory;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
include_once "../../../vendor/autoload.php";
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $Http =  HttpRequestFactory::make(HTTPConstants::HTTP_REQUEST,[]);
    $data = $Http->getHttpData();
    if(isset($data['request'])&&!empty($data['request'])){
        /** @var  userDao $userDao */
        $userDao = DaoFactory::make(DaoClassConstants::USER_DAO,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
        $productDao = DaoFactory::make(DaoClassConstants::PRODUCTS,[$userDao->connect]);
        $cur_user_row = $userDao->getCurrentUserByEmail($_SESSION['user_agent']);
        $getAllProduct = $productDao->getThisProductDetails($_POST['request']);
        


    }
    else{
        echo "UNKNOWN REQUEST!";
    }
}
else{
    session_destroy();
    ?>
        <script>
            window.location=("../../?error=Session NOT found!!");
        </script>
    <?php
}
?>