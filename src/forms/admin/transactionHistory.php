<?php

use Classes\dao\userDao;
use Classes\DBConnect\DBConnect;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;
use Src\constants\Flags;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
include_once "../../../vendor/autoload.php";
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    if(isset($_GET['query'])&&($_GET['query']===Flags::TRANSACTION_TYPE_DEPOSIT || $_GET['query']===Flags::TRANSACTION_TYPE_WITHDRAW)){
        /** @var  userDao $userDao */
        $userDao = DaoFactory::make(DaoClassConstants::USER_DAO,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
        $transactionDao = DaoFactory::make(DaoClassConstants::TRANSACTION_DAO,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
        $cur_user_row =$userDao->getCurrentUserByEmail($_SESSION['user_agent']);
        if($_GET['query']===Flags::TRANSACTION_TYPE_DEPOSIT){
            $deposit=$transactionDao->createTransactionStatement(Flags::TRANSACTION_TYPE_DEPOSIT);
            $string = "<div class='flex padding-5' style='font-weight:bold;'>
                            <div class='padding-5' style='width:40%;text-align:center;'>TIME</div>
                            <div class='padding-5' style='width:40%;text-align:center;'>REASON</div>
                            <div class='padding-5' style='width:40%;text-align:center;'>AMOUNT</div>
                            <div class='padding-5' style='width:40%;text-align:center;'>TYPE</div>
                            <div class='padding-5' style='width:40%;text-align:center;'>TRANSACTOR</div>
                            <div class='padding-5' style='width:40%;text-align:center;'>GRANTED BY</div>
                       </div>";
            foreach($deposit as $data){
                $string.="<div class='flex padding-5'>
                            <div class='padding-5' style='width:40%;'>{$data['action_time']}</div>
                            <div class='padding-5' style='width:40%;'>{$data['reason']}</div>
                            <div class='padding-5' style='width:40%;'>R{$data['amount']}</div>
                            <div class='padding-5' style='width:40%;'>{$data['type']}</div>
                            <div class='padding-5' style='width:40%;'>{$data['transactor']}</div>
                            <div class='padding-5' style='width:40%;'>{$data['name']}</div>
                         </div>";
            }
            echo "<div style='border:2px solid #dddddd;border-radius:10px;'>".$string."</div>";
        }
        else{
             $withdraw=$transactionDao->createTransactionStatement(Flags::TRANSACTION_TYPE_WITHDRAW);
             $string = "<div class='flex padding-5' style='font-weight:bold;'>
                            <div class='padding-5' style='width:40%;text-align:center;'>TIME</div>
                            <div class='padding-5' style='width:40%;text-align:center;'>REASON</div>
                            <div class='padding-5' style='width:40%;text-align:center;'>AMOUNT</div>
                            <div class='padding-5' style='width:40%;text-align:center;'>TYPE</div>
                            <div class='padding-5' style='width:40%;text-align:center;'>TRANSACTOR</div>
                            <div class='padding-5' style='width:40%;text-align:center;'>GRANTED BY</div>
                       </div>";
            foreach($withdraw as $data){
                $string.="<div class='flex padding-5'>
                            <div class='padding-5' style='width:40%;'>{$data['action_time']}</div>
                            <div class='padding-5' style='width:40%;'>{$data['reason']}</div>
                            <div class='padding-5' style='width:40%;'>R{$data['amount']}</div>
                            <div class='padding-5' style='width:40%;'>{$data['type']}</div>
                            <div class='padding-5' style='width:40%;'>{$data['transactor']}</div>
                            <div class='padding-5' style='width:40%;'>{$data['name']}</div>
                         </div>";
            }
            echo "<div style='border:2px solid #dddddd;border-radius:10px;'>".$string."</div>";
        }
    }
    else{
        echo"UNKNOWN REQUEST!!";
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