<?php
namespace Classes\generator;

use Src\constants\ServiceConstants;
use Mmshightech\mmshightech;
use Mmshightech\interfaceLet\IDataGenerator;
use Src\constants\Flags;
class DataGenerator {
	public mmshightech $connection;
	public function __construct(mmshightech|null $connection){
		if(!isset($connection)){
			$this->functionErrorHandLer($connection);
		}
		$this->connection=$connection;
	}
	public function functionErrorHandLer($dataReturn='NULL'):array{
		return ['error'=>"{$dataReturn} Connection Not Found."];
	}
	public function getTransactionData($transactionType):array{
		$sql = "select 
					reason, 
					amount, 
					(select name_surname from makhathi_chickens_users where id = transactor) as transactor, 
					type, 
					action_time,
					(select name_surname from makhathi_chickens_users where id = permitted_by) as name
			    from internal_transactions where type=? order by id DESC
		";
		return $this->connection->getAllDataSafely($sql,'s',[$transactionType])??[];
	}
	public function getTotalAmountOfTransaction(?string $transactionType)
	:float{
		$sql ='select sum(amount) as total from internal_transactions where type=?';
		$results=$this->connection->getAllDataSafely($sql,'s',[$transactionType])[0]??[];
		return floatval($results['total']??0.00);
	}
	public function getAmountOnCredit($clientUserId):array{
        $sql = "select amount,amount_with_interest,repayment_amount from credits_users where user_id=?";
        return $this->connection->getAllDataSafely($sql,'s',[$clientUserId])[0]??[];

    }
    public function userOnCreditUsers(?int $clientUserId):bool{
        $sql="select user_id from credits_users where user_id=?";
        return ($this->connection->numRows($sql,'s',[$clientUserId])==1);
    }
}
?>