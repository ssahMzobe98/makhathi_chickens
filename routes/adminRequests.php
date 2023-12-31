<?php
include "../vendor/autoload.php";
$e = "UNKNOWN REQUEST!!";
use Classes\LoginProcessor;
use Src\constants\StatusConstants;
use Classes\dao\userDao;
use Classes\DBConnect\DBConnect;
use Mmshightech\service\factory\daoFactory\DaoFactory;
$processorCleanData=new LoginProcessor(null);
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
include_once "../../vendor/autoload.php";
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
	/** @var  userDao $userDao */
	$userDao = DaoFactory::make(DaoClassConstants::USER_DAO,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
	$cur_user_row =$userDao->getCurrentUserByEmail($_SESSION['user_agent']);
	if(isset($_POST['productTitle'],$_POST['productProductType'],$_POST['productSubTitle'],$_POST['productSize'],$_POST['productPrice'],$_POST['productInstock'],$_POST['productDescription'])){
		if(isset($_FILES)){
			$productTitle=$processorCleanData->cleanDataSet($_POST['productTitle']);
			$productProductType=$processorCleanData->cleanDataSet($_POST['productProductType']);
			$productSubTitle=$processorCleanData->cleanDataSet($_POST['productSubTitle']);
			$productSize=$processorCleanData->cleanDataSet($_POST['productSize']);
			$productPrice=$processorCleanData->cleanDataSet($_POST['productPrice']);
			$productInstock=$processorCleanData->cleanDataSet($_POST['productInstock']);
			$productDescription=$processorCleanData->cleanDataSet($_POST['productDescription']);
			$response = $processorCleanData->createNewProduct($productTitle,$productProductType,$productSubTitle,$productSize,$productPrice,$productInstock,$productDescription,$cur_user_row['id']);
			if($response===StatusConstants::SUCCESS_STATUS){
				$e=1;
			}
			else{
				$e=$response->responseMessage;
			}
		}
		else{
			$e="Missing Product image file.";
		}
		
	}
	echo json_encode($e);
}
else{
	session_destroy();
	?>
		<script>
			window.location=("../?error=Invalid Session!!");
		</script>
	<?php
}
?>