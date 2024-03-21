<?php
namespace Mmshightech\service\factory;

use Classes\generator\DataGenerator;
use Src\constants\ServiceConstants;
use Mmshightech\mmshightech;
use App\Http\Middleware\Authenticate;
class DataGeneratorFactory{
	protected static array $data=[
			ServiceConstants::GENERATE_DATA => DataGenerator::class,
			ServiceConstants::API_AUTH => Authenticate::class

	];
	public static function make(string $tagertClass,array $array){
		$cl = self::$data[ServiceConstants::GENERATE_DATA];
		if(!empty(self::$data[$tagertClass])){
			$cl = self::$data[$tagertClass];
		}
		return new $cl(...$array);
	}
}
?>