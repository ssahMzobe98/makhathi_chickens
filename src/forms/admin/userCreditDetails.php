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
    if(isset($_POST['request'])&&$_POST['request']>0){
        /** @var  userDao $userDao */
        $userDao = DaoFactory::make(DaoClassConstants::USER_DAO,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
        $cur_user_row = $userDao->getCurrentUserByEmail($_SESSION['user_agent']);
        $userOnCredits = $userDao->getCreditHistoryUserUId($_POST['request']);
        if($userOnCredits['id']){
            $creditHistory=$userDao->getCreditHistory($userOnCredits['id']);
            $maxAmount = 2000.00;
            $payableAmountData = $userDao->getCreditPayableAmount($userOnCredits['id'])??[];
            $repayment_amount= $payableAmountData['repayment_amount']??0;//amount paid so far
            $payableAmount = $payableAmountData['amount_with_interest']??0.00;
            $payableAmount-=$repayment_amount;
            $amountWithoutInterest = $payableAmountData['amount']??0.00;

            ?>
            <div class="bodyTag padding-10 flex">
                <div class='credit-history padding-10' style="width:30%; border: 2px solid #dddddd;border-radius: 10px;">
                    <center><h2>Credits History</h2></center>
                    <div class="padding-10" style="height:70vh;">
                        <?php
                            $display="";
                            foreach($creditHistory as $history){
                                $display.="<div class='padding-10 flex'>
                                                <div class='padding-10'>{$history['transaction_day']}</div>
                                                <div class='padding-10'>{$history['action_type']}</div>
                                                <div class='padding-10'>R".number_format($history['amount'],2)."</div>
                                           </div>
                                          ";
                            }
                            if($display===""){
                                $display = "NO RECORDS FOUND!";
                            }
                            echo $display;
                        ?>
                    </div>
                </div>
                <?php
                    $badge = "badge-primary";
                    if($amountWithoutInterest>$maxAmount){
                        $badge = "badge-secondary";
                    }
                ?>
                <div class='credit-right padding-10' style="width:70%;">
                    <div class='padding-10' style="border:2px solid #dddddd;border-radius: 10px;">
                        <center><h2>Credit Details</h2></center>
                        <div class="flex" style="height:70vh;">
                            <div class="padding-10" style="width:50%;">
                                <div style="width:100%;border: 1px solid #dddddd;border-radius: 10px;" class="padding-5">
                                    <center><h2 style="width:100%;border: 1px solid #dddddd;border-radius: 10px;">Credit</h2></center>
                                    <div class="padding-10">
                                        <div class="flex padding-5">
                                            <div style="color:green;text-align: center;width:50%;">Available Credit: R<?php echo number_format($maxAmount-$amountWithoutInterest,2);?> </div>
                                            <div style="color:red;text-align: center;width:50%;">Payable Credit: R <?php echo number_format($payableAmount,2);?></div>   
                                        </div>
                                        <div class="padding-5">
                                            
                                            <div style="width:100%;"><input style="width:100%;border-radius:10px;border:2px solid #dddddd;padding:10px;background: none;" type="number" class="creditRequestAmount" id="creditRequestAmount" oninput="creditRequestAmount(<?php echo ($maxAmount-$amountWithoutInterest);?>,<?php echo $userOnCredits['id'];?>)" placeholder="Enter Credit Amount"></div>
                                            <div class="padding-5 w-100 responseError" hidden></div>
                                            <div class="padding-5">
                                                <span class="badge <?php echo $badge;?> text-white" id="badgeDome" style="width:100%;border-radius:2px solid navy;border:2px;text-align: center;cursor: pointer;" onclick="sendCreditRequest(<?php echo ($maxAmount-$amountWithoutInterest);?>,<?php echo $userOnCredits['id'];?>)">Send request</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="padding-10" style="width:50%;">
                                <div style="width:100%;border: 1px solid #dddddd;border-radius: 10px;" class="padding-5">
                                    <center><h2 style="width:100%;border: 1px solid #dddddd;border-radius: 10px;">Payment</h2></center>
                                    <div class="padding-10">
                                        <div class="flex padding-5">
                                            <div style="color:red;text-align: center;width:100%;">Outstanding Balance: R<?php echo number_format($payableAmount,2);?> </div>  
                                        </div>
                                        <div class="padding-5">
                                            <?php
                                                $badge = "badge-primary";
                                                if($amountWithoutInterest>$maxAmount){
                                                    $badge = "badge-secondary";
                                                }
                                            ?>
                                            <div style="width:100%;"><input style="width:100%;border-radius:10px;border:2px solid #dddddd;padding:10px;background: none;" type="number" class="creditPaymentRequestAmount" id="creditPaymentRequestAmount" oninput="creditPaymentRequestAmount(<?php echo $amountWithoutInterest;?>,<?php echo $userOnCredits['id'];?>)" placeholder="Enter Re-Payment Amount"></div>
                                            <div class="padding-5 w-100 repaymentResponseError" hidden></div>
                                            <div class="padding-5">
                                                <span class="badge <?php echo $badge;?> text-white" id="sendCreditPaymentRequest" style="width:100%;border-radius:2px solid navy;border:2px;text-align: center;cursor: pointer;" onclick="sendCreditPaymentRequest(<?php echo $payableAmount;?>,<?php echo $userOnCredits['id'];?>)">Send request</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                </div>
            </div>
            <?php
        }
        else{
            echo"Client ID-{$_POST['request']} NOT Found";
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