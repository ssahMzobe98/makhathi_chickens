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
    $productDao = DaoFactory::make(DaoClassConstants::PRODUCTS,[$userDao->connect]);
    
    $cur_user_row = $userDao->getCurrentUserByEmail($_SESSION['user_agent']);
    $getAllProduct = $productDao->getProductDetails();
    ?>
    <div style="width:100%;padding:10px 10px;display: flex;">
        <div></div>
        User Credits Details
    </div>
    <div class="container" style="border-radius: 10px;border:2px solid #dddddd;">
        <table id="example" class="table table-striped" style="width:100%;border:2px solid #dddddd;border-radius: 10px;">
            <thead>
            <tr>
                <th>Product#</th>
                <th>product_title</th>
                <th>product_subtitle</th>
                <th>product_description</th>
                <th>type</th>
                <th>size</th>
                <th>price</th>
                <th>instock</th>
                <th>Manage Product</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    foreach($getAllProduct as $products){
                        ?>
                         <tr class="removeLogRow<?php echo $products['id'];?>">
                            <td onclick="domeSquareModal('ProductDetails','<?php echo $products['id'];?>')"><?php echo $products['id'];?></td>
                            <td><?php echo $products['product_title'];?></td>
                            <td><?php echo $products['product_subtitle'];?></td>
                            <td><?php echo $products['product_description'];?></td>
                            <td><?php echo $products['type'];?></td>
                            <td><div class="button-success"><?php echo $products['size'];?></div></td>
                            <td>R<?php echo number_format($products['price'],2);?></td>
                            <td><?php echo $products['instock'];?></td>
                            <td> <span class="removeLog<?php echo $products['id'];?>" onclick="removeProduct('<?php echo $products['id'];?>')"><i class='bx bx-trash' style="font-size: 25px;cursor: pointer;"></i></span></td>
                        </tr>
                        <?php

                    }
                ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Product#</th>
                <th>product_title</th>
                <th>product_subtitle</th>
                <th>product_description</th>
                <th>type</th>
                <th>size</th>
                <th>price</th>
                <th>instock</th>
                <th>Manage Product</th>
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