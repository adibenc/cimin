<?php

/* 
$fb = (new FilterBuilder())
->render();
*/

class FilterBuilder{
	public $kejatis = [];
	// todo conditional
	public $btns = "";
	public $s_bidang = "";
	public $s_kejati = "";
	public $s_showAll = "";
	
	public $_role = "";

	function __construct() {
		$this->setup();
		$_ci = &get_instance();
		$this->_ci = &get_instance();

		$this->set_role($_ci->session->userdata("akses"));
	}
	
	function render(){
		echo $this->getRendered();
	}

	function setup(){
		$s_kejati_opts = "";
		foreach($this->getKejatis() as $row){
			$ink = $row['inst_satkerkd'];
			$ina = $row['inst_nama'];
			$s_kejati_opts .= <<<HTML
				<option value="$ink">$ina</option> 
			HTML;
		}

		// $btns = 
		$this->setBtns(<<<HTML
			<button id="btCari" class="btn btn-primary btn-sm cari" data-bta="dis-after-click">
				<i class="icon-search4 position-left"></i>
				Cari
			</button>
			<button class="btn btn-primary btn-sm" id="btnPrint">
				<i class="icon-printer position-left"></i>Cetak
			</button>
		HTML)
		->sets_bidang(<<<HTML
			<div class="col-md-2">
				<select class="form-control form-control-sm" name="bidang" id="pilihBidang">
					<option value="0">{semua}</option>
					<option value="1">Orang dan Harta Benda</option>
					<option value="2">Kamnegtimbum dan TPUL</option>
					<option value="3">Narkotika dan Zat Adiktif Lainnya</option>
					<option value="4">Terorisme dan Lintas Negara</option>
				</select>
			</div>
		HTML)
		->setS_kejati(<<<HTML
			<div class="col-md-2">
				<select class="form-control form-control-sm" name="kt" id="pilihKejati">
					<!-- <option value="">Pilih Kejati</option> -->
					$s_kejati_opts
				</select>
			</div>
		HTML);

		return $this;
	}

	// global override for filter builder
	function overrideRule(){
		$role = $this->get_role();
		if($role == "pidsus"){
			$this->sets_bidang("");
		}
	}
	
	function getRendered(){
		$this->overrideRule();
		
		$s_kejati = $this->getS_kejati();
		$s_bidang = $this->gets_bidang();
		$s_showAll = $this->s_showAll;

		$y_opts = "";
		for($y=date("Y");$y>2018;$y--){
			$y_opts .= <<<HTML
				<option value="$y"> $y </option>
			HTML;
		}
		$s_year = <<<HTML
			<div class="col-md-1">
				<select class="form-control form-control-sm" name="tahun" id="pilihTahun">
					$y_opts
				</select>
			</div>
		HTML;

		$btns = $this->getBtns();

		return <<<HTML
			$s_kejati
			<div class="col-md-2">
				<select class="form-control form-control-sm" name="kn" id="pilihKejari" data-id="$s_showAll">
					<option value="0">Kejaksaan Agung</option>
				</select>
			</div>
			$s_bidang
			$s_year
			<div class="col-md-2">
			<div class="input-group input-group-sm mb-3">
			<select class="form-control form-control-sm" name="bulan" id="pilihBulan">
					<!-- <option value="0">Semua bulan</option> -->
					<option value="1">Januari</option>
					<option value="2">Februari</option>
					<option value="3">Maret</option>
					<option value="4">April</option>
					<option value="5">Mei</option>
					<option value="6">Juni</option>
					<option value="7">Juli</option>
					<option value="8">Agustus</option>
					<option value="9">September</option>
					<option value="10">Oktober</option>
					<option value="11">November</option>
					<option value="12">Desember</option>
				</select><span class="input-group-text">s.d</span><select class="form-control form-control-sm" name="bulanEnd" id="pilihBulanEnd">
					<!-- <option value="0">Semua bulan</option> -->
					<option value="1">Januari</option>
					<option value="2">Februari</option>
					<option value="3">Maret</option>
					<option value="4">April</option>
					<option value="5">Mei</option>
					<option value="6">Juni</option>
					<option value="7">Juli</option>
					<option value="8">Agustus</option>
					<option value="9">September</option>
					<option value="10">Oktober</option>
					<option value="11">November</option>
					<option value="12">Desember</option>
				</select></div>
			</div>
			
			<div class="col-md-2">
				$btns
			</div>
		HTML;
	}

	/**
	 * Get the value of kejatis
	 */ 
	public function getKejatis()
	{
		return $this->kejatis;
	}

	/**
	 * Set the value of kejatis
	 *
	 * @return  self
	 */ 
	public function setKejatis($kejatis)
	{
		$this->kejatis = $kejatis;

		return $this;
	}

	public function setShowAll($s)
	{
		$this->s_showAll = $s;

		return $this;
	}

	/**
	 * Get the value of btns
	 */ 
	public function getBtns()
	{
		return $this->btns;
	}

	/**
	 * Set the value of btns
	 *
	 * @return  self
	 */ 
	public function setBtns($btns)
	{
		$this->btns = $btns;

		return $this;
	}

	/**
	 * Get the value of s_bidang
	 */ 
	public function gets_bidang()
	{
		return $this->s_bidang;
	}

	/**
	 * Set the value of s_bidang
	 *
	 * @return  self
	 */ 
	public function sets_bidang($s_bidang)
	{
		$this->s_bidang = $s_bidang;

		return $this;
	}

	/**
	 * Get the value of s_kejati
	 */ 
	public function getS_kejati()
	{
		return $this->s_kejati;
	}

	/**
	 * Set the value of s_kejati
	 *
	 * @return  self
	 */ 
	public function setS_kejati($s_kejati)
	{
		$this->s_kejati = $s_kejati;

		return $this;
	}

	/**
	 * Get the value of _role
	 */ 
	public function get_role()
	{
		return $this->_role;
	}

	/**
	 * Set the value of _role
	 *
	 * @return  self
	 */ 
	public function set_role($_role)
	{
		$this->_role = $_role;

		return $this;
	}
}