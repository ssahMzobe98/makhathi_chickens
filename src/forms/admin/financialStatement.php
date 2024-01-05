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
    $allUserUidsAndNames=$userDao->getUserUidsAndNames($cur_user_row['id']);
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
        .spanBtn{
            background: navy;
            color: white;
            border-radius: 50px;
            cursor: pointer;
        }
        .spanBtn:hover{
            background: #dddddd;
            color:navy;
        }
    </style>
    <div class="flex padding-10 w-100">
        <div class="w-50 leftSet padding-10">
            <div class="data">
                <div class="padding-10 ">
                    <center><h5>Deposits</h5></center>
                </div>
            </div>
            <div class="padding-5 w-100">
                <div class="input-vals w-100 padding-5">
                    <textarea placeholder="Reason to deposit.." class="productInput DepositReason padding-10 w-100" style="width:100%;"></textarea>
                </div>
                <div class="flex">
                    <div class="input-vals w-100 padding-5">
                        <input type="text" placeholder="Amount to Deposit" class="productInput DepositAmount padding-10 w-100" style="width:100%;"/>
                    </div>
                    <div class="input-vals w-100 padding-5">
                        <select class="productInput Depositer padding-10 w-100" style="width:100%;">
                            <option value="">-- Select Depositer</option>
                            <?php
                                foreach ($allUserUidsAndNames as $arr) {
                                    echo '<option value="'.$arr['user_id'].'">'.$arr['name'].'</option>';  
                                }
                            ?>
                        </select>
                    </div>
                    <div class="input-vals w-50 padding-5">
                        <span class="padding-10 w-100 spanBtn" onclick="deposit()">Deposit</span>
                    </div>
                </div>
            </div>  
            <div class="processing1" hidden></div>  
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
                            <input type="text" placeholder="Amount to widthdraw" class="productInput withdrawalAmount padding-10 w-100" style="width:100%;"/>
                        </div>
                        <div class="input-vals w-100 padding-5">
                            <select class="productInput withDrawer padding-10 w-100" style="width:100%;">
                                <option value="">-- Select Requester</option>
                                <?php
                                    foreach ($allUserUidsAndNames as $arr) {
                                        echo '<option value="'.$arr['user_id'].'">'.$arr['name'].'</option>';  
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-vals w-50 padding-5">
                            <span class="padding-10 w-100 spanBtn" onclick="widthdraw()">Withdraw</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="processing" hidden></div>
            
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