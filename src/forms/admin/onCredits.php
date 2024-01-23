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
    /** @var  userDao $userDao */
    $userDao = DaoFactory::make(DaoClassConstants::USER_DAO,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
    $cur_user_row = $userDao->getCurrentUserByEmail($_SESSION['user_agent']);
    $getAllAppUsers = $userDao->getAllAppUsers();
    ?>
    <div style="width:100%;padding:10px 10px;display: flex;">
        <div></div>
        User Credits Details
    </div>
    <div class="container" style="border-radius: 10px;border:2px solid #dddddd;">
        <table id="example" class="table table-striped" style="width:100%;border:2px solid #dddddd;border-radius: 10px;">
            <thead>
            <tr>
                <th >User#</th>
                <th>User Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>isOnCredit</th>
                <th>Max Credit Amount</th>
                <th>Current Credit Amount</th>
                <th>Payable Amount</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    foreach($getAllAppUsers as $users){
                        $payableAmount = $users['tax']+$users['interest']+$users['amount'];
                        ?>
                         <tr>
                            <td onclick="openUserOnCredit('<?php echo $users['user_id'];?>')"><?php echo $users['user_id'];?></td>
                            <td><?php echo $users['name'];?></td>
                            <td><?php echo $users['address'];?></td>
                            <td><?php echo $users['email'];?></td>
                            <td><?php echo $users['phone'];?></td>
                            <td><div class="button-success"><?php echo $users['is_credit_ready'];?></div></td>
                            <td>R<?php echo number_format($users['credit_max_amount'],2);?></td>
                            <td>R<?php echo number_format($users['amount'],2);?></td>
                            <td>R<?php echo number_format($payableAmount,2);?></td>
                        </tr>
                        <?php

                    }
                ?>
            </tbody>
            <tfoot>
            <tr>
                <th >User#</th>
                <th>User Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>isOnCredit</th>
                <th>Max Credit Amount</th>
                <th>Current Credit Amount</th>
                <th>Payable Amount</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $("#example").DataTable();
        });
    </script>


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