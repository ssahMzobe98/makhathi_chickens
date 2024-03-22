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
use App\Http\HTTPConstants\HTTPConstants;
use Mmshightech\service\factory\HttpRequest\HttpRequestFactory;
// $=new LoginProcessor(null);
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
	$Http =  HttpRequestFactory::make(HTTPConstants::HTTP_REQUEST,[]);
    $data = $Http->getHttpData();
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
		if(isset($data['fname'],$data['userPhoneNo'],$data['userEmailAddress'],$data['userPassword'],$data['gender'])){
			$fname = $processorCleanData->cleanDataSet($data['fname']);
			$userPhoneNo = $processorCleanData->cleanDataSet($data['userPhoneNo']);
			$userEmailAddress = $processorCleanData->cleanDataSet($data['userEmailAddress']);
			$userPassword = $processorCleanData->cleanDataSet($data['userPassword']);
			$gender = $processorCleanData->cleanDataSet($data['gender']);
			$e = $userDao->createNewAdminUser($fname,$userPhoneNo,$userEmailAddress,$userPassword,$gender,$cur_user_row['id']);
			
		}
		elseif(isset($data['removeProductUid'],$data['statusCodeRemoval'])){
			$removeProductUid = $processorCleanData->cleanDataSet($data['removeProductUid']);
			$statusCodeRemoval = $processorCleanData->cleanDataSet($data['statusCodeRemoval']);
			$e = $productDao->removeProductByUid($removeProductUid,$statusCodeRemoval);
		}
		elseif(isset($data['transactReason'],$data['transactAmount'],$data['transactPerson'],$data['transactType'])){
			$transactReason = $processorCleanData->cleanDataSet($data['transactReason']);
			$transactAmount = $processorCleanData->cleanDataSet($data['transactAmount']);
			$transactPerson = $processorCleanData->cleanDataSet($data['transactPerson']);
			$transactType = $processorCleanData->cleanDataSet($data['transactType']);
			$e = $transactionDao->MakeTransaction($transactReason,$transactAmount,$transactPerson,$transactType,$cur_user_row['id']);
			
		}
		elseif(isset($data['re_payment_payableAmount'], $data['re_payment_clientUserId'], $data['re_payment_Payment'])){
			$re_payment_payableAmount = $processorCleanData->cleanDataSet($data['re_payment_payableAmount']);
			$re_payment_clientUserId = $processorCleanData->cleanDataSet($data['re_payment_clientUserId']);
			$re_payment_Payment = $processorCleanData->cleanDataSet($data['re_payment_Payment']);
			$e = $transactionDao->MakeCreditPaymentTransaction($re_payment_payableAmount,$re_payment_clientUserId,$re_payment_Payment,$cur_user_row['id']);
		}
		elseif(isset($data['requestAmount'],$data['maxAmount'],$data['clientUserId'])){
			$requestAmount = $processorCleanData->cleanDataSet($data['requestAmount']);
			$maxAmount = $processorCleanData->cleanDataSet($data['maxAmount']);
			$clientUserId = $processorCleanData->cleanDataSet($data['clientUserId']);
			$e = $transactionDao->MakeCreditTransaction($requestAmount,$maxAmount,$clientUserId,$cur_user_row['id']);
		}
		elseif(isset($data['productTitle'],$data['productProductType'],$data['productSubTitle'],$data['productSize'],$data['productPrice'],$data['productInstock'],$data['productDescription'])){
			if(isset($_FILES['fileAddProduct'])){
				$productTitle = $processorCleanData->cleanDataSet($data['productTitle']);
				$productProductType = $processorCleanData->cleanDataSet($data['productProductType']);
				$productSubTitle = $processorCleanData->cleanDataSet($data['productSubTitle']);
				$productSize = $processorCleanData->cleanDataSet($data['productSize']);
				$productPrice = $processorCleanData->cleanDataSet($data['productPrice']);
				$productInstock = $processorCleanData->cleanDataSet($data['productInstock']);
				$productDescription = $processorCleanData->cleanDataSet($data['productDescription']);
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
		elseif(isset($data['logout'])){
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