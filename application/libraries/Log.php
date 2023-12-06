<?php

include_once(__DIR__."/Logger.php");

class Log{
	static function info($msg){
		$logger = new Logger();
		$logger->setFilename("general.log");
		return $logger->info($msg);
	}
}