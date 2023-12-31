<?php

use Classes\dao\userDao;
use Classes\DBConnect\DBConnect;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
include_once "../vendor/autoload.php";
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    /** @var  userDao $userDao */
    $userDao = DaoFactory::make(DaoClassConstants::USER_DAO,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
    $cur_user_row =$userDao->getCurrentUserByEmail($_SESSION['user_agent']);
    ?>
    <div class="imgLogoSetter">
        <img src="../img/loginDisplay-removebg-preview.png">
        <h5>Welcome <?php echo $cur_user_row['name_surname'];?></h5>
    </div>
    <?php
    $dataRow['product_discountable']="Y";
    $promo = ($dataRow['product_discountable']=='Y')?'<div style="width:20%;" title="promo item">
                                                <i class="fa fa-star" style="font-size: medium;color:#dddddd;border-radius:100px;border:2px solid #dddddd;" aria-hidden="true"></i>
                                            </div>':'';
    $dataRow['is_instock']='Y';
    $in_stock=($dataRow['is_instock']=='Y')?'<i class="fa fa-check" style="font-size: medium;color:#dddddd;border-radius:100px;border:2px solid #dddddd;" aria-hidden="true"></i>
                                            ':'<i class="fa fa-times" style="font-size: medium;color:darkred;border-radius:100px;border:2px solid darkred;" aria-hidden="true"></i>
                                            ';
    ?>
    <div class="SetterBodyHaiv">
        <div class="massivBlockDisplay">
            <div class="ProductReader">
                <div class="reform-format">
                    <div class="img-tag">
                        <img src="../img/fullBrandedChicken-removebg-preview.png" >
                    </div>
                    <div class="Counter-tag">
                        <div class="dopeIn-ex">
                            <div title="Add Item to cart"><i  class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                            <div title="Quantity of items in cart" style="font-size:15px;padding: 8px 0; text-align: center;" class="itemQuantity">2</div>
                            <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
                <div class="ProductBottom" style="color: #dddddd;">
                    <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                        <div style="font-size: smaller;width:80%;" class="price-product">R200.00</div>
                        <?php echo $promo;?>
                        <div style="width:20%;" title="in stock">
                            <?php echo $in_stock;?>
                        </div>
                    </div>
                </div>
                <p style="font-size: x-small;text-wrap:wrap;">hjkhkjhkhk kjkjh kjhkjh kjhkj kkjhk khkhj</p>
            </div>
        </div>
        <div class="massivBlockDisplay">
            <div class="ProductReader">
                <div class="reform-format">
                    <div class="img-tag">
                        <img src="../img/30eggs-removebg-preview.png" >
                    </div>
                    <div class="Counter-tag">
                        <div class="dopeIn-ex">
                            <div title="Add Item to cart"><i  class="fa fa-plus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                            <div title="Quantity of items in cart" style="font-size:15px;padding: 8px 0; text-align: center;" class="itemQuantity">2</div>
                            <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:30px; " aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
                <div class="ProductBottom" style="color: #dddddd;">
                    <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                        <div style="font-size: smaller;width:80%;" class="price-product">R200.00</div>
                        <?php echo $promo;?>
                        <div style="width:20%;" title="in stock">
                            <?php echo $in_stock;?>
                        </div>
                    </div>
                </div>
                <p style="font-size: x-small;text-wrap:wrap;">hjkhkjhkhk kjkjh kjhkjh kjhkj kkjhk khkhj</p>
            </div>
        </div>
        <div class="massivBlockDisplay">
            <div class="ProductReader">
                <div class="reform-format">
                    <div class="img-tag">
                        <img src="../img/fullChicken-removebg-preview.png" >
                    </div>
                    <div class="Counter-tag">
                        <div class="dopeIn-ex">
                            <div title="Add Item to cart"><i  class="fa fa-plus-circle" style="cursor:pointer;font-size:31px; " aria-hidden="true"></i></div>
                            <div title="Quantity of items in cart" style="font-size:15px;padding: 8px 0; text-align: center;" class="itemQuantity">500</div>
                            <div title="remove Item from cart"><i class="fa fa-minus-circle" style="cursor:pointer;font-size:31px; " aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
                <div class="ProductBottom" style="color: #dddddd;">
                    <div style="font-size: smaller;width:100%; display:flex;padding: 2px 0;">
                        <div style="font-size: smaller;width:80%;" class="price-product">R200.00</div>
                        <?php echo $promo;?>
                        <div style="width:20%;" title="in stock">
                            <?php echo $in_stock;?>
                        </div>
                    </div>
                </div>
                <p style="font-size: x-small;text-wrap:wrap;">hjkhkjhkhk kjkjh kjhkjh kjhkj kkjhk khkhj</p>
            </div>
        </div>
    </div>
    <?php
}
?>
