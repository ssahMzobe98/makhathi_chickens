<?php

use Classes\dao\userDao;
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

        <h5>Order Details</h5>
    <div class="container" style="border-radius: 10px;border:2px solid #dddddd;">
        <table id="example" class="table table-striped" style="width:100%;border:2px solid #dddddd;border-radius: 10px;">
            <thead>
            <tr>
                <th >Order#</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Size</th>
                <th>Bags</th>
                <th>Status</th>
                <th>Date Time</th>
                <th>Processedby</th>
                <th>Delivered|Collected by</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td onclick="openOrderDetails(12345)">12345</td>
                <td>Ndlovu Thokale</td>
                <td>ab12 adams mission Amanzimtoti 4123</td>
                <td>abcemail@gmail.com</td>
                <td>014 785 2369</td>
                <td>Large</td>
                <td><div class="button-red">6</div></td>
                <td>Invoiced</td>
                <td>2023-12-08 10h10</td>
                <td>MMS ADMIN</td>
                <td>Waiting For Collection</td>
            </tr>
            <tr>
                <td>12345</td>
                <td>Ndlovu Thokale</td>
                <td>ab12 adams mission Amanzimtoti 4123</td>
                <td>abcemail@gmail.com</td>
                <td>014 785 2369</td>
                <td>Large</td>
                <td><div class="button-success">4</div></td>
                <td>Invoiced</td>
                <td>2023-12-08 10h10</td>
                <td>MMS ADMIN</td>
                <td>Waiting For Collection</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th>Order#</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Size</th>
                <th>Bags</th>
                <th>Status</th>
                <th>Date Time</th>
                <th>Processedby</th>
                <th>Delivered|Collected by</th>
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
?>
