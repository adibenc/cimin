<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(__DIR__."/BaseModel.php");

class MsPenyidikModel extends BaseModel {
	public $table = "dashpdm.ms_penyidik";

	public function getDistinct(){
		return $this->builder([], false)->select("distinct id_penyidik, nama", false)
			->get()->result();
	}
}