<?php

use Classes\dao\userDao;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
include_once "../../../vendor/autoload.php";
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])) {
    /** @var  userDao $userDao */
    $userDao = DaoFactory::make(DaoClassConstants::USER_DAO, [(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
    $cur_user_row = $userDao->getCurrentUserByEmail($_SESSION['user_agent']);
    if(isset($_POST['request']) && !empty($_POST['request'])){
        ?>
        <div style="width:100%;display:flex;">
            <div class="leftPadding">
                <div class="details box-shadow">
                    <h3 style="text-align: center">Order #6465464</h3>
                    <div class="datetimeDetails flex">
                        <div class="datetimeDetailsPaddding">
                            <label>
                                Order Date Time
                                <input type="date" value="2023-12-08">
                            </label>

                        </div>
                        <div class="datetimeDetailsPaddding">
                            <label>
                                Order Delivery Time
                                <input type="date" value="2023-12-08">
                            </label>
                        </div>
                    </div>

                    <div style="padding: 5px 5px;border-bottom: 2px solid #dddddd">
                        <h4>Notes</h4>
                        <p>fsdf dsf sdf sdfsd fsdf safdf dsfasdf sdf sdf sdf asf sddf sdf safd sdf sdaf sdf </p>
                    </div>
                    <div style="padding: 5px 5px;border-bottom: 2px solid #dddddd">
                        <style>
                            th{
                                padding: 5px 5px;
                            }
                        </style>
                        <table>
                            <tr>
                                <th>Customer</th>
                                <th>Name of the customer</th>
                            </tr>
                            <tr>
                                <th>Contact</th>
                                <th>abcd@gmail.com</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>0245 875 254</th>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <th>customer address must come here</th>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <th>Collection | Delivery</th>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="order-details box-shadow">
                        <h4>Order Timeline</h4>

                        <style>
                            .Order-time-line {
                                padding: 4px 4px;
                            }
                        </style>
                        <div class="Order-time-line">
                            <span style="padding: 2px 2px;border-radius: 100%;font-size: x-large;">
                                <i class="fa fa-shopping-basket" style="color: green;" aria-hidden="true"></i>
                            </span>
                            <span class="badge badge-secondary text-white" style="padding: 10px 10px;">
                                Order Received!!
                            </span>
                            <span style="padding: 2px 2px;border-radius: 100%;font-size: x-large;">
                                <i class="fa fa-check-circle" style="color: green;" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="Order-time-line">
                        <span style="padding: 2px 2px;border-radius: 100%;font-size: x-large;">
                                <i class="fa fa-shopping-basket" style="color: green;" aria-hidden="true"></i>
                            </span>
                            <span class="badge badge-secondary text-white" style="padding: 10px 10px;">Order Accepted</span>
                            <span style="padding: 2px 2px;border-radius: 100%;font-size: x-large;">
                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="Order-time-line">
                        <span style="padding: 2px 2px;border-radius: 100%;font-size: x-large;">
                                <i class="fa fa-shopping-basket" style="color: green;" aria-hidden="true"></i>
                            </span>
                            <span class="badge badge-secondary text-white" style="padding: 10px 10px;">Order Invoiced</span>
                            <span style="padding: 2px 2px;border-radius: 100%;font-size: x-large;">
                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="Order-time-line">
                        <span style="padding: 2px 2px;border-radius: 100%;font-size: x-large;">
                                <i class="fa fa-shopping-basket" style="color: green;" aria-hidden="true"></i>
                            </span>
                            <span class="badge badge-secondary text-white" style="padding: 10px 10px;">Order Processing</span>
                            <span style="padding: 2px 2px;border-radius: 100%;font-size: x-large;">
                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="Order-time-line">
                        <span style="padding: 2px 2px;border-radius: 100%;font-size: x-large;">
                                <i class="fa fa-shopping-basket" style="color: green;" aria-hidden="true"></i>
                            </span>
                            <span class="badge badge-secondary text-white" style="padding: 10px 10px;">Order Ready for collection</span>
                            <span style="padding: 2px 2px;border-radius: 100%;font-size: x-large;">
                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rightPadding">
                <div class="order-details box-shadow">
                    <table id="example" class="table table-striped" style="width:100%;border:2px solid #dddddd;border-radius: 10px;">
                        <thead>
                        <tr>
                            <th >Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>kljnlkgdf gfdklngdf gdfkgndfkg dfkgjndfg<p><small>21Kg</small></p></td>
                            <td>2</td>
                            <td>R43.65</td>
                            <td>R87.25</td>
                        </tr>
                        <tr>
                            <td>kljnlkgdf gfdklngdf gdfkgndfkg dfkgjndfg<p><small>21Kg</small></p></td>
                            <td>2</td>
                            <td>R43.65</td>
                            <td>R87.25</td>
                        </tr>
                        <tr>
                            <td>kljnlkgdf gfdklngdf gdfkgndfkg dfkgjndfg<p><small>21Kg</small></p></td>
                            <td>2</td>
                            <td>R43.65</td>
                            <td>R87.25</td>
                        </tr>
                        </tbody>

                    </table>
                    <div class="substance flex" style="padding: 10px 10px;">
                        <div style="padding: 10px 10px;width:70%;"><span style="padding: 5px 5px;">Status</span> <span style="padding: 5px 5px;"><i style="padding: 5px 5px;color:green;font-size: large;" class="fa fa-check-circle" aria-hidden="true"></i></span> <span>Collection</span></div>
                        <div>
                            <table>
                                <tr>
                                    <th>Sub Total </th>
                                    <th>: R1 552.35 </th>
                                </tr>
                                <tr>
                                    <th>Vat </th>
                                    <th>: R25.36 </th>
                                </tr>
                                <tr>
                                    <th>Sys Fee </th>
                                    <th>: R13.00 </th>
                                </tr>
                                <tr>
                                    <th>Delivery Fee </th>
                                    <th>: R15.00 </th>
                                </tr>
                                <tr>
                                    <th>Total Amount </th>
                                    <th>: R1 830.14 </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <script>
            $(document).ready(function(){
                $("#example").DataTable();
            });
        </script>
        <?php
    }
    else{
        echo"<center>UNKNOWN REQUEST</center>";
    }
}
else{
session_destroy();
?>
    <script>
        window.loaction=("../../");
    </script>
<?php
}
?>
