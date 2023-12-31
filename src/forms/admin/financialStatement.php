<?php

use Classes\dao\userDao;
use Classes\DBConnect\DBConnect;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
include_once "../../../vendor/autoload.php";
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    /** @var  userDao $userDao */
    $userDao = DaoFactory::make(DaoClassConstants::USER_DAO,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
    $cur_user_row =$userDao->getCurrentUserByEmail($_SESSION['user_agent']);
    ?>
    <style>
        .data{
            border:1px solid #dddddd;
            border-radius: 10px;
            width: 100%;
        }
        .productInput{
            border:1px solid #dddddd;
            border-radius: 20px;

        }
    </style>
    <div class="flex padding-10 w-100">
        <div class="w-50 leftSet padding-10">
            <div class="data">
                <div class="padding-10 ">
                    <center><h5>Deposits</h5></center>
                </div>
            </div>
                
        </div>
        <div class="w-50 rightSet padding-10">
            <div class="data">
                <div class="padding-10">
                    <center><h5>Withdrawals</h5></center>
                </div>
                <div class="padding-5 w-100">
                    <div class="input-vals w-100 padding-5">
                        <textarea placeholder="Reason for withdrawal.." class="productInput WithDrawalReason padding-10 w-100" style="width:100%;"></textarea>
                    </div>
                    <div class="flex">
                        <div class="input-vals w-100 padding-5">
                            <input type="text" placeholder="Amount to widthdraw" class="productInput WithDrawalReason padding-10 w-100" style="width:100%;"/>
                        </div>
                        <div class="input-vals w-100 padding-5">
                            <select class="productInput WithDrawalReason padding-10 w-100" style="width:100%;">
                                <option value="">-- Select Requester</option>
                            </select>
                        </div>
                        <div class="input-vals w-100 padding-5">
                            <input placeholder="Reason for withdrawal.." class="productInput WithDrawalReason padding-10 w-100" style="width:100%;"/>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <?php
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