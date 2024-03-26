<?php

use Classes\dao\userDao;
use Classes\DBConnect\DBConnect;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;
use Src\constants\Flags;
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
        $cur_user_row = $userDao->getCurrentUserByEmail($_SESSION['user_agent']);
        $SysUsers = $userDao->getSystemUsers();
        ?>
        <div style="width:100%;padding:10px 10px;display: flex;">
            <div></div>
            Products Details | <span onclick='loadAfterQuery(".makhanyile","../../src/forms/admin/manageProduct.php?status=S")' class="badge badge-primary text-white text-center">Suspended Products</span> | <span onclick='loadAfterQuery(".makhanyile","../../src/forms/admin/manageProduct.php?status=D")' class="badge badge-danger text-white text-center">De-Activated Products</span>
        </div>
        <div class="container" style="border-radius: 10px;border:2px solid #dddddd;">
            <table id="example" class="table table-striped" style="width:100%;border:2px solid #dddddd;border-radius: 10px;">
                <thead>
                <tr>
                    <th>User#</th>
                    <th>First & Last Name</th>
                    <th>Username</th>
                    <th>type</th>
                    <th>Phone</th>
                    <th>Delivery Address</th>
                    <th>Credit Barea</th>
                    <th>Credit Balance</th>
                    <th>Account Status</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($SysUsers as $user){
                            ?>
                             <tr class="removeLogRow<?php echo $user['id'];?>">
                                <td onclick="domeSquareModal('UserDetails','<?php echo $user['id'];?>')"><?php echo $user['id'];?></td>
                                <td><?php echo $user['name_surname'];?></td>
                                <td><?php echo $user['email'];?></td>
                                <td><?php echo $user['user_type'];?></td>
                                <td><?php echo $user['phone'];?></td>
                                <td><?php echo $user['credit_berea'];?></td>
                                <td><?php echo $user['CreditBalance'];?></td>
                                <td><?php echo $user['AccStatus'];?></td>
                                <td>
                                    <span class="removeLog<?php echo $user['id'];?>" onclick="removeProduct('<?php echo $user['id'];?>','D')"><i class='bx bx-trash' style="font-size: 25px;cursor: pointer;"></i></span>
                                </td>
                            </tr>
                            <?php

                        }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>User#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>type</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Delivery Address</th>
                    <th>Credit Barier</th>
                    <th>Account Status</th>
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