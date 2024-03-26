<?php
namespace Mmshightech\interfaceLet\IConnectionService;
use Classes\response\Response;
interface IConnectionService{
	public function getAllDataSafely($query, $paramType="", $paramArray=[]):array;
    public function postDataSafely($query, $paramType, $paramArray):Response;
    public function execute($query, $paramType="", $paramArray=array());
    public function bindQueryParams($stmt, $paramType, $paramArray=array());
    public function numRows($query, $paramType="", $paramArray=array()):int;
    public function DBClose();
}
?>