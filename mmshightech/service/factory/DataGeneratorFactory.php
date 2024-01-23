<?php
namespace Mmshightech\service\factory;

use Classes\generator\DataGenerator;
use Src\constants\ServiceConstants;
use Mmshightech\mmshightech;
class DataGeneratorFactory{
	protected static array $data=[
			ServiceConstants::GENERATE_DATA => DataGenerator::class
	];
	public static function make(string $tagertClass,mmshightech $connection){
		$cl = self::$data[ServiceConstants::GENERATE_DATA];
		if(!empty(self::$data[$tagertClass])){
			$cl = self::$data[$tagertClass];
		}
		return new $cl($connection);
	}
}
?>