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
		$sql = "INSERT into products(product_title,product_description,product_subtitle,type,size,price,instock,img,updated_by,added_datetime)values(?,?,?,?,?,?,?,?,?,NOW())";
		$params = [$productTitle,$productDescription,$productSubTitle,$productProductType,$productSize,$productPrice,$productInstock,$newName,$adminId];
		return $this->connect->postDataSafely($sql,'sssssssss',$params);
	}
	public function updateNewProduct(?string $newName=null,?int $productId=null):Response{
		$sql = "UPDATE products set img=? where id=?";
		$params = [$newName,$productId];
		return $this->connect->postDataSafely($sql,'ss',$params);
	}
	public function getProductDetails(?string $status=null):array{
		$sql = "SELECT id,product_title,product_description,product_subtitle,type,size,price,instock from products where status=?";
		return $this->connect->getAllDataSafely($sql,'s',[$status])??[];
	}
	public function removeProductByUid(?int $removeProductUid=null,string $statusCodeRemoval=Flags::ACTIVE_STATUS):Response{
		$sql="UPDATE products set status=? where id=?";
		return $this->connect->postDataSafely($sql,'ss',[$statusCodeRemoval,$removeProductUid]);
	}
	public function getThisProductDetails(?int $productId=null):array{
		if($productId === null){
			return [];
		}
		$sql="SELECT id,img,product_title,product_description,product_subtitle,type,size,price,instock,status from products where id=?";
		return $this->connect->getAllDataSafely($sql,'s',[$productId])[0]??[];
	}
	public function updateProductDetails(string|int|null $productTitleUpdate=null,string|int|null $productProductTypeUpdate=null,string|int|null $productSubTitleUpdate=null,string|int|null $productSizeUpdate=null,string|int|null $productPriceUpdate=null,string|int|null $productInstockUpdate=null,string|int|null $productDescriptionUpdate=null,?int $ProductIdUpdateDetails=null):Response{
		$sql = "UPDATE products set product_title=?,product_description=?,product_subtitle=?,type=?,size=?,price=?,instock=? where id=?";
		$params = [$productTitleUpdate,$productDescriptionUpdate,$productSubTitleUpdate,$productProductTypeUpdate,$productSizeUpdate,$productPriceUpdate,$productInstockUpdate,$ProductIdUpdateDetails];
		return $this->connect->postDataSafely($sql,'ssssssss',$params);

	}

}
?>