<?php

class LoggerModel extends CI_Model{
    private $enabled = true;
    
    public function __construct(){
        $this->enabled = true;
        $this->load->library("Logger", "logger");
        // $this->logger
    }

	/**
	 * $this->load->model('LoggerModel', 'mlogger');
	 * $this->mlogger->logs(1, "string");
	 */
	// $this->mlogger->logs(1, "string");
	public function logs($type = "", $data = null){
		$isEnabled = $this->getEnabled();
		if(!$isEnabled){
			return null;
		}
		$ret = null;
		$msg = "";
		$encoded = json_encode($data);
		switch($type){
			case "general":
			default:
				$this->logger->setFilename("general.log");
				$encoded = $data;
				$msg = "general ";
			break;
		}
		
		try{
			$ret = @$this->logger->info($msg.$encoded);
		}catch(\Exception $e){
			$ret = @$this->logger->info("Logger exception : ".$e->getMessage());
		}

		return $ret;
	}
 
	public function getEnabled(){
		return $this->enabled;
	}

	public function setEnabled($enabled){
		$this->enabled = $enabled;

		return $this;
    }
    
	public function enable(){
		return $this->setEnabled(true);
    }
    
	public function disable(){
		return $this->setEnabled(false);
	}
}