<?php

/**
 * 
 * monolog-like logger for Codeigniter 3
 * use it as library or manually include
 * 
 * @adib-enc
 * 
 */
class BaseLib{
	public $table = "logs";
	
	public function __construct($type = "file"){
		$this->initLib();
	}

	public function initLib(){
		$this->ci = &get_instance();
		$this->load = $this->ci->load;
		$this->load->model("LogModel", "mlog");
		$this->mlog = $this->ci->mlog;
		$this->db = $this->ci->db;
	}
}