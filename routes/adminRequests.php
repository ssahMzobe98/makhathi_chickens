<?php
include "../vendor/autoload.php";
use Src\constants\StatusConstants;
use Classes\dao\userDao;
use Classes\DBConnect\DBConnect;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;
use Classes\response\Response;
use Src\constants\Flags;
use Classes\logs\WriteResponseLog;
// $=new LoginProcessor(null);
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
	$e = new Response();
	$e->responseStatus = Flags::FAILED_STATUS;
	$e->responseMessage = 'UNKNOWN REQUEST';
	try{
		/** @var  userDao $userDao */
		$processorCleanData = DaoFactory::make(DaoClassConstants::PROCESSOR_CLEAN_DATA,[null]);
		$userDao = DaoFactory::make(DaoClassConstants::USER_DAO,[$processorCleanData->connect]);
		$productDao = DaoFactory::make(DaoClassConstants::PRODUCTS,[$userDao->connect]);
		$transactionDao = DaoFactory::make(DaoClassConstants::TRANSACTION_DAO,[$userDao->connect]);
		
		$cur_user_row =$userDao->getCurrentUserByEmail($_SESSION['user_agent']);
		if(isset($_POST['fname'],$_POST['userPhoneNo'],$_POST['userEmailAddress'],$_POST['userPassword'],$_POST['gender'])){
			$fname = $processorCleanData->cleanDataSet($_POST['fname']);
			$userPhoneNo = $processorCleanData->cleanDataSet($_POST['userPhoneNo']);
			$userEmailAddress = $processorCleanData->cleanDataSet($_POST['userEmailAddress']);
			$userPassword = $processorCleanData->cleanDataSet($_POST['userPassword']);
			$gender = $processorCleanData->cleanDataSet($_POST['gender']);
			$e = $userDao->createNewAdminUser($fname,$userPhoneNo,$userEmailAddress,$userPassword,$gender,$cur_user_row['id']);
			
		}
		elseif(isset($_POST['removeProductUid'],$_POST['statusCodeRemoval'])){
			$removeProductUid = $processorCleanData->cleanDataSet($_POST['removeProductUid']);
			$statusCodeRemoval = $processorCleanData->cleanDataSet($_POST['statusCodeRemoval']);
			$e = $productDao->removeProductByUid($removeProductUid,$statusCodeRemoval);
		}
		elseif(isset($_POST['transactReason'],$_POST['transactAmount'],$_POST['transactPerson'],$_POST['transactType'])){
			$transactReason = $processorCleanData->cleanDataSet($_POST['transactReason']);
			$transactAmount = $processorCleanData->cleanDataSet($_POST['transactAmount']);
			$transactPerson = $processorCleanData->cleanDataSet($_POST['transactPerson']);
			$transactType = $processorCleanData->cleanDataSet($_POST['transactType']);
			$e = $transactionDao->MakeTransaction($transactReason,$transactAmount,$transactPerson,$transactType,$cur_user_row['id']);
			
		}
		elseif(isset($_POST['re_payment_payableAmount'], $_POST['re_payment_clientUserId'], $_POST['re_payment_Payment'])){
			$re_payment_payableAmount = $processorCleanData->cleanDataSet($_POST['re_payment_payableAmount']);
			$re_payment_clientUserId = $processorCleanData->cleanDataSet($_POST['re_payment_clientUserId']);
			$re_payment_Payment = $processorCleanData->cleanDataSet($_POST['re_payment_Payment']);
			$e = $transactionDao->MakeCreditPaymentTransaction($re_payment_payableAmount,$re_payment_clientUserId,$re_payment_Payment,$cur_user_row['id']);
		}
		elseif(isset($_POST['requestAmount'],$_POST['maxAmount'],$_POST['clientUserId'])){
			$requestAmount = $processorCleanData->cleanDataSet($_POST['requestAmount']);
			$maxAmount = $processorCleanData->cleanDataSet($_POST['maxAmount']);
			$clientUserId = $processorCleanData->cleanDataSet($_POST['clientUserId']);
			$e = $transactionDao->MakeCreditTransaction($requestAmount,$maxAmount,$clientUserId,$cur_user_row['id']);
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
					$e->responseStatus = Flags::FAILED_STATUS;
	   				$e->responseMessage = $ext[1]." Not supported. Only png,jpg,img format supported.";
				}
				else{
					$dir="../img/";
					$newName=rand(0,1000).'_'.$ext[0].".".$ext[1];
					if(!move_uploaded_file($_FILES['fileAddProduct']['tmp_name'], $dir.$newName)){
						$e->responseStatus = Flags::FAILED_STATUS;
	   					$e->responseMessage = 'Failed to upload file due to network!, Please try again.';
						
					}
					else{
						$e = $productDao->addNewProduct($productTitle,$productProductType,$productSubTitle,$productSize,$productPrice,$productInstock,$productDescription,$newName,$cur_user_row['id']);
					}
				}
			}
			else{
				$e->responseStatus = Flags::FAILED_STATUS;
	   			$e->responseMessage = 'Thumbnail File required!';
			}
		}
		elseif(isset($_POST['logout'])){
			unset($_SESSION['user_agent'],$_SESSION['var_agent']);
			session_destroy();
			$e->responseStatus = Flags::SUCCESS_STATUS;
			$e->responseMessage = 'Logut Success.';
		}
	}
	catch (\Exception $m) {
	   $erroObject= WriteResponseLog::exceptionBuiler($m);
	   $e->responseStatus = Flags::FAILED_STATUS;
	   $e->responseMessage = $m->getMessage();
	   WriteResponseLog::writelogResponse('../storage/logs/', $erroObject->issueType, $erroObject->class, $erroObject->method, $erroObject);
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