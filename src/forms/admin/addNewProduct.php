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
    <div class="range_sort">
        <h2>Add new product</h2>
        <div class="img-set">
            <input type="file" class="fileAddProduct" id="fileAddProduct">
        </div>
        <style>
            .productInput{
                width:100%;
                padding: 10px 10px;
                border:1px solid #dddddd;
                border-radius: 10px;

            }
        </style>
        <div class="flex flex-wrap padding-10 center-content" style="width: 100%;padding:10px 50px;">
            <div class="padding-20 center-content" style="width: 33.3%;">
                <label >
                    Product Title
                </label>
                    <input type="text" class="productInput productTitle" placeholder="Product Title">
            </div>
            <div class="padding-20 center-content" style="width: 33.3%;">
                <label >
                    Type
                </label>
                <input type="text" class="productInput productProductType" placeholder="Product Type">
            </div>
            <div class="padding-20 center-content" style="width: 33.3%;">
                <label >
                    Product Sub Title
                </label>
                <input type="text" class="productInput productSubTitle" placeholder="Product Sub Title">
            </div>
            <div class="padding-20 center-content" style="width: 33.3%;">
                <label >
                    Size
                </label>
                <input type="number" class="productInput productSize" placeholder="Product Size">
            </div>
            <div class="padding-20 center-content" style="width: 33.3%;">
                <label >
                    Product Price
                </label>
                <input type="text" class="productInput productPrice" placeholder="Product price">
            </div>
            <div class="padding-20 center-content" style="width: 33.3%;">
                <label >
                    Product Instock
                </label>
                <input type="number" class="productInput productInstock" placeholder="Product Instock">
            </div>

        </div>
        <div class="flex flex-wrap padding-10 center-content" style="width: 100%;padding:10px 50px;border-bottom: 2px solid #dddddd;">
            <div class="padding-20 center-content" style="width: 100%;">
                <label >
                    Product Description
                </label>
                <textarea class="productInput productDescription" placeholder="Product Description"></textarea>
            </div>
        </div>
        <div class="flex flex-wrap padding-10" >
            <span onclick="addNewProduct()" style="padding: 10px 10px;border-radius: 10px 10px;background: #1a202c;color:white;cursor: pointer;">Save Product</span>
        </div>
        <br>
        <div class="processing padding" hidden></div>

    </div>
    <?php
}
else{
    session_destroy();
    ?>
    <script>
        window.location=("../../");
    </script>
<?php
}
?>
