<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(__DIR__."/BaseModel.php");

class MInsSatker extends BaseModel {
	public $table = "kepegawaian.kp_inst_satker_all";

	public function getDistinct(){
		return $this->builder([], false)->select("distinct id_penyidik, nama", false)
			->get()->result();
	}
}