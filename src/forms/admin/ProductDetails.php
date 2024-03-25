<?php

use Classes\dao\userDao;
use Classes\DBConnect\DBConnect;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;
use Src\constants\Flags;
use App\Http\Controllers\HTTPRequests\HTTPRequests;
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
        $productDao = DaoFactory::make(DaoClassConstants::PRODUCTS,[$userDao->connect]);
        $cur_user_row = $userDao->getCurrentUserByEmail($_SESSION['user_agent']);
        $getAllProduct = $productDao->getThisProductDetails($_POST['request']);
        $dir = '../../img/'.$getAllProduct['img'];
        ?>
        <div style="padding:10px 10px;display: flex;width: 100%;">
            <div style="padding:10px 10px;width:15%;">
                <div>
                    <img src="<?php echo $dir;?>" style='width:100%;'>
                </div>
            </div>
            <div class="range_sort">
                <h2>Product Details</h2>
                <div class="img-set" style="display: flex;">
                    <input type="file" class="fileAddProductUpdate" id="fileAddProductUpdate" oninput="fileAddProductUpdate(<?php echo $getAllProduct['id'];?>)">
                    <div hidden class="imgResponseRequest"></div>
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
                            <input type="text" value="<?php echo $getAllProduct['product_title'];?>" class="productInput productTitleUpdate" placeholder="Product Title">
                    </div>
                    <div class="padding-20 center-content" style="width: 33.3%;">
                        <label >
                            Type
                        </label>
                        <input type="text" value="<?php echo $getAllProduct['type'];?>" class="productInput productProductTypeUpdate" placeholder="Product Type">
                    </div>
                    <div class="padding-20 center-content" style="width: 33.3%;">
                        <label >
                            Product Sub Title
                        </label>
                        <input type="text" value="<?php echo $getAllProduct['product_subtitle'];?>" class="productInput productSubTitleUpdate" placeholder="Product Sub Title">
                    </div>
                    <div class="padding-20 center-content" style="width: 33.3%;">
                        <label >
                            Size
                        </label>
                        <input type="number" value="<?php echo $getAllProduct['size'];?>" class="productInput productSizeUpdate" placeholder="Product Size">
                    </div>
                    <div class="padding-20 center-content" style="width: 33.3%;">
                        <label >
                            Product Price
                        </label>
                        <input type="text" value="<?php echo number_format($getAllProduct['price'],2);?>" class="productInput productPriceUpdate" placeholder="Product price">
                    </div>
                    <div class="padding-20 center-content" style="width: 33.3%;">
                        <label >
                            Product Instock
                        </label>
                        <input type="number" value="<?php echo $getAllProduct['instock'];?>" class="productInput productInstockUpdate" placeholder="Product Instock">
                    </div>

                </div>
                <div class="flex flex-wrap padding-10 center-content" style="width: 100%;padding:10px 50px;border-bottom: 2px solid #dddddd;">
                    <div class="padding-20 center-content" style="width: 100%;">
                        <label >
                            Product Description
                        </label>
                        <textarea class="productInput productDescriptionUpdate" placeholder="Product Description"><?php echo $getAllProduct['product_description'];?></textarea>
                    </div>
                </div>
                <div class="flex flex-wrap padding-10" >
                    <span onclick="UpdateProduct(<?php echo $getAllProduct['id'];?>)" style="padding: 10px 10px;border-radius: 10px 10px;background: #1a202c;color:white;cursor: pointer;">Update Product</span>
                </div>
                <br>
                <div class="processing padding" hidden></div>

            </div>
            
        </div>
        
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
?>