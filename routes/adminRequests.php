<?php
include "../vendor/autoload.php";
$e = "UNKNOWN REQUEST!!";
use Classes\LoginProcessor;
use Src\constants\StatusConstants;
use Classes\dao\userDao;
use Classes\DBConnect\DBConnect;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;
$processorCleanData=new LoginProcessor(null);
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
	/** @var  userDao $userDao */
	$userDao = DaoFactory::make(DaoClassConstants::USER_DAO,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
	$productDao = DaoFactory::make(DaoClassConstants::PRODUCTS,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
	$transactionDao = DaoFactory::make(DaoClassConstants::TRANSACTION_DAO,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);

	$cur_user_row =$userDao->getCurrentUserByEmail($_SESSION['user_agent']);
	if(isset($_POST['fname'],$_POST['userPhoneNo'],$_POST['userEmailAddress'],$_POST['userPassword'],$_POST['gender'])){
		$fname = $processorCleanData->cleanDataSet($_POST['fname']);
		$userPhoneNo = $processorCleanData->cleanDataSet($_POST['userPhoneNo']);
		$userEmailAddress = $processorCleanData->cleanDataSet($_POST['userEmailAddress']);
		$userPassword = $processorCleanData->cleanDataSet($_POST['userPassword']);
		$gender = $processorCleanData->cleanDataSet($_POST['gender']);
		$response = $userDao->createNewAdminUser($fname,$userPhoneNo,$userEmailAddress,$userPassword,$gender,$cur_user_row['id']);
		if($response->responseStatus===StatusConstants::SUCCESS_STATUS){
			$e=1;
		}
		else{
			$e=$response->responseMessage;
		}
	}
	elseif(isset($_POST['transactReason'],$_POST['transactAmount'],$_POST['transactPerson'],$_POST['transactType'])){
		$transactReason = $processorCleanData->cleanDataSet($_POST['transactReason']);
		$transactAmount = $processorCleanData->cleanDataSet($_POST['transactAmount']);
		$transactPerson = $processorCleanData->cleanDataSet($_POST['transactPerson']);
		$transactType = $processorCleanData->cleanDataSet($_POST['transactType']);
		$response = $transactionDao->MakeTransaction($transactReason,$transactAmount,$transactPerson,$transactType,$cur_user_row['id']);
		if($response->responseStatus===StatusConstants::SUCCESS_STATUS){
			$e=1;
		}
		else{
			$e=$response->responseMessage;
		}
	}
	elseif(isset($_POST['re_payment_payableAmount'], $_POST['re_payment_clientUserId'], $_POST['re_payment_Payment'])){
		$re_payment_payableAmount = $processorCleanData->cleanDataSet($_POST['re_payment_payableAmount']);
		$re_payment_clientUserId = $processorCleanData->cleanDataSet($_POST['re_payment_clientUserId']);
		$re_payment_Payment = $processorCleanData->cleanDataSet($_POST['re_payment_Payment']);
		$response = $transactionDao->MakeCreditPaymentTransaction($re_payment_payableAmount,$re_payment_clientUserId,$re_payment_Payment,$cur_user_row['id']);
		if($response->responseStatus===StatusConstants::SUCCESS_STATUS){
			$e=1;
		}
		else{
			$e=$response->responseMessage;
		}
	}
	elseif(isset($_POST['requestAmount'],$_POST['maxAmount'],$_POST['clientUserId'])){
		$requestAmount = $processorCleanData->cleanDataSet($_POST['requestAmount']);
		$maxAmount = $processorCleanData->cleanDataSet($_POST['maxAmount']);
		$clientUserId = $processorCleanData->cleanDataSet($_POST['clientUserId']);
		$response = $transactionDao->MakeCreditTransaction($requestAmount,$maxAmount,$clientUserId,$cur_user_row['id']);
		if($response->responseStatus===StatusConstants::SUCCESS_STATUS){
			$e=1;
		}
		else{
			$e=$response->responseMessage;
		}
	}
	elseif(isset($_POST['productTitle'],$_POST['productProductType'],$_POST['productSubTitle'],$_POST['productSize'],$_POST['productPrice'],$_POST['productInstock'],$_POST['productDescription'])){
		if(isset($_FILES['fileAddProduct'])){
			$productTitle = $processorCleanData->cleanDataSet($_POST['productTitle']);
			$productProductType = $processorCleanData->cleanDataSet($_POST['productProductType']);
			$productSubTitle = $processorCleanData->cleanDataSet($_POST['productSubTitle']);
			$productSize = $processorCleanData->cleanDataSet($_POST['productSize']);
			$productPrice = $processorCleanData->cleanDataSet($_POST['productPrice']);
			$productInstock = $processorCleanData->cleanDataSet($_POST['productInstock']);
			$productDescription = $processorCleanData->cleanDataSet($_POST['productDescription']);
			$ext = explode(".", $_FILES['fileAddProduct']['name']);
			if(!in_array($ext[1], ['png','PNG','JPG','jpg','heit','HEIT'])){
				$e= $ext[1]." Not supported. Only png,jpg,img format supported.";
			}
			else{
				$dir="../img/";
				$newName=rand(0,1000).'_'.$ext[0].".".$ext[1];
				if(!move_uploaded_file($_FILES['fileAddProduct']['tmp_name'], $dir.$newName)){
					$e='Failed to upload file due to network!, Please try again.';
				}
				else{
					$response = $productDao->addNewProduct($productTitle,$productProductType,$productSubTitle,$productSize,$productPrice,$productInstock,$productDescription,$newName,$cur_user_row['id']);
					if($response->responseStatus===StatusConstants::SUCCESS_STATUS){
						$e=1;
					}
					else{
						$e=$response->responseMessage;
					}
				}
			}
		}
		else{
			$e="Thumbnail File required!";
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