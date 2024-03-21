<?php
namespace Classes\logs;
class WriteResponseLog{
	private static $connectionManager;
	private static $configs;
	private static $default_settings=[
		'type'=>['error']
	];
	private static array $logFiles=[];
	public static function writelogResponse(string $dir='./',string $logType='Error',string $class='No class provided',string $method='No method provided',string|int|float|array|null| $data){
		self::logResponse2Disk($dir,$logType,$class,$method,$data);

	}
	public static function logResponse2Disk(string $dir='./', string $logType='Error', string $class='No class provided', string $method='No method provided', $data=null) {
        $logMessage = "[" . date('Y-m-d H:i:s') . "] [$logType] [$class::$method] ";
        $logMessage .= is_scalar($data) ? $data : json_encode($data);
        $logMessage .= PHP_EOL;
        $logFilePath = rtrim($dir, '/') . '/' . str_replace('\\', '_', $class) . '_log.log';
        file_put_contents($logFilePath, $logMessage, FILE_APPEND);
    }
}

?>