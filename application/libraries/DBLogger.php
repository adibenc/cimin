<?php
include_once(__DIR__."/Logger.php");

/**
 * 
 * monolog-like logger for Codeigniter 3
 * use it as library or manually include
 * 
 * @adib-enc
 * 
 */
class DBLogger extends Logger{
	public $table = "logs";
	
	public function __construct($type = "file"){
		$this->ci = &get_instance();
		$this->load = $this->ci->load;
		$this->load->model("LogModel", "mlog");
		$this->mlog = $this->ci->mlog;
		$this->db = $this->ci->db;
		// $db = $this->ci->load->database('auth', TRUE);
		// $this->db = $db;
		$this->mlog->setDB($this->db);

		$this->setDefaultDir()
			->setDefaultFilename();
	}

	public function setupRowData($t="x", $d1=null, $d2=null){
		$ret = $this->getDefaultRowData();
		$ret['data1'] = $d1;
		$ret['data2'] = $d2;
		
		switch($t){
			case "authed":
				$user = $this->ci->session->get_userdata("user");
				if($user){
					$ret['actor'] = $user->username;
					$ret['user_id'] = $user->user_id;
				}
			break;
		}
		$this->setRowData($ret);

		return $this;
	}

	/*
	$lrow = (new AuthLogRow)
			->appendToLtype($ctx)
			->setData1("data1")
			->setData2("data2");
	$this->dblogger->setRowDataFromObj($lrow)->info();
	*/
	public function setRowDataFromObj(LogRow $obj){
		$this->rowData = $obj->toArray();
		return $this;
	}
	
	public function setRowData($rowData){
		$this->rowData = $rowData;
		return $this;
	}

	public function getDefaultRowData(){
		return [
			'c1' => "sys",
			'ltype' => "sys",
			'actor' => "sys",
			'user_id' => null,
			'code' => null,
			'data1' => null,
			'data2' => null,
			'stat' => null,
		];
	}

	public function getRowData(){
		return $this->rowData ? $this->rowData : $this->getDefaultRowData();
	}

	public function appendToDB($text="x"){
		logs(json_encode($this->getRowData()));
		$ret = $this->mlog->setTimestamp(true)->create(
			$this->getRowData()
		);

		// $this->mlog->checkError();
		$err = $this->mlog->getError();
		if($err['message']){
			logs(json_encode($err));
		}

		return true;
	}

	// append text 2 db
	public function addRecord(int $level, string $message, array $context = []): bool{
		if( !empty($context)){
			$context = json_encode($context);
		}else{
			$context = "";
		}
		$arr = [$level, $message, $context];
		$text = implode(" ", $arr);

		return $this->appendToDB($text);
	}
}