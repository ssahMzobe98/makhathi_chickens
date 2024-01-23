<?php
namespace Classes\dao;

use Classes\DBConnect\DBConnect;
use Classes\response\Response;
use Mmshightech\mmshightech;
use Mmshightech\service\CleanData;
use Classes\traits\DBConnectTrait;
use Src\constants\StatusConstants;
use Src\constants\Flags;
class productDao extends CleanData
{
	use DBConnectTrait;
	public function addNewProduct($productTitle,$productProductType,$productSubTitle,$productSize,$productPrice,$productInstock,$productDescription,$newName,$adminId):Response{
		$sql = "insert into products(product_title,product_description,product_subtitle,type,size,price,instock,img,updated_by,added_datetime)values(?,?,?,?,?,?,?,?,?,NOW())";
		$params = [$productTitle,$productDescription,$productSubTitle,$productProductType,$productSize,$productPrice,$productInstock,$newName,$adminId];
		return $this->connect->postDataSafely($sql,'sssssssss',$params);
	}

}
?>