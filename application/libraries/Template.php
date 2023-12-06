<?php

use Melbahja\Seo\MetaTags;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//
include_once(__DIR__."/BaseTemplate.php");

class Template extends BaseTemplate{
	protected $_ci;
	protected $load;
	protected $_baseurl;
	
	protected $MsPenyidikModel;

	protected $withKT;
	protected $withPenyidik;

	// todo
	// protected $withJaksa;
	
	function __construct() {
		$this->_ci = &get_instance();
		$this->load = $this->_ci->load;
		$this->load->model('db_model');
		$this->db_model = $this->_ci->db_model;

		$this->load->model('MsPenyidikModel');
		$this->MsPenyidikModel = $this->_ci->MsPenyidikModel;

		// $this->metatags = $this->createMeta();
		$this->_baseurl = base_url();
	}

	public function createMeta(){
		$metatags = new MetaTags();
        $metatags->title('Kejaksaan Agung Republik Indonesia')
            ->description('Kejaksaan RI adalah lembaga hukum Indonesia')
            ->meta('keywords', 'Kejaksaan RI, indonesia, hukum, hakim, adil, undang undang, Tri Krama Adhyaksa')
            ->image($this->_baseurl."assets/img/logo-kejak.png");
        
        return $metatags;
    }

	function setSeoMetas($t="link", $arg=[]){
		// $cleanDesc = substr( htmlentities(arrget($arg, 'desc')) , 0, 160);
		$cleanDesc = substr( strip_tags(arrget($arg, 'desc')) , 0, 160);

		$this->metatags->title(arrget($arg, 'title'))
			->description($cleanDesc);
		$kw = arrget($arg, 'keywords');
		if($kw){
			$this->metatags->meta("keywords", $kw);
		}

		switch($t){
			case "berita":
			break;
			case "link":
			break;
			// home
			default:
		}

		return $this;
	}
	
	function includesHTMLs(){
		include_once(__DIR__."/Input.php");
		include_once(__DIR__."/Views/FilterBuilder.php");
	}

	function display($template, $data=null){
		$this->includesHTMLs();
		$data['_baseurl'] = $this->_baseurl;

		$data['penyidik'] = [];
		if($this->getWithPenyidik()){
			$arr = $this->MsPenyidikModel->getDistinct();
			$data['penyidik'] = json_decode(json_encode($arr), true);
		}

		$user = $this->_ci->session->userdata("user");
		$role = $this->_ci->session->userdata("akses");
		$insKode = $user->ins_satkerkd;
		$absInsCode = KejaksaanEnt::padKodeInstansi($insKode);
		$parsedCode = KejaksaanEnt::parseInsCode($absInsCode);

		$isCentral = false;
		$isKT = false;
		$isKN = false;

		if($user){
			$isCentral = $user->ins_satkerkd == "00";
			$isKT = $user->inst_satkerinduk == "00";
			// $isKN = $user->inst_satkerinduk != "00";
			$isKN = !$isCentral && !$isKT;
		}

		$data['_user'] = $user;
		$data['_inst_nama'] = $user->inst_nama;
		$data['_inst_satkerkd'] = $insKode;
		$data['_inst_parsed'] = $parsedCode;
		$data['_role'] = $role;

		$data['isCentral'] = $isCentral;
		$data['isKT'] = $isKT;
		$data['isKN'] = $isKN;
		
		// always inject kt data IF withkt is true
		if($this->getWithKT()){
			// $this->db->order_by('inst_nama');
			$this->_ci->load->model('MInsSatker', "minstansi");
			$kt = $parsedCode['kt'];
			$minsBuilder = $this->_ci->minstansi->builder()
				->where(['inst_satkerinduk' => '00']);
			
			if($isCentral){
				// $minsBuilder = $minsBuilder->where(['inst_satkerinduk' => '00']);
			}else if($isKT || $isKN){
				$minsBuilder = $minsBuilder
					->where("inst_satkerkd = '$kt'", null, false);
					// ->where("substr(inst_satkerkd, 0, 2) = '$insKode'", null, false);
			}

			$data['kejati'] = $minsBuilder->get()->result_array();
		}

		$data['pendidikan'] = $this->db_model
			->get('public.ms_pendidikan')
			->result_array();

		$data['agama'] = $this->db_model
			->get('public.ms_agama')
			->result_array();

		$data['pekerjaan'] = $this->db_model
			->get('public.ms_pekerjaan')
			->result_array();

		$data['cekhal'] = $template;
		$data['_include'] = $this->_ci->load->view('template/include',$data,TRUE);
		$data['_header'] = $this->_ci->load->view('template/header',$data,TRUE);
		$data['_content'] = $this->_ci->load->view(''.$template,$data,TRUE);
		$data['_footer'] = $this->_ci->load->view('template/footer',$data,TRUE);
		$data['_scripts'] = "x";

		$data['currentYear'] = date("Y");

		$arr = $this->parseContent($template, $data);
		$data = array_merge($data, $arr);
		
		$this->_ci->load->view('template/template.php', $data);
		// pr($data);
	}

	function admin($template,$data=null) {
		$data['cekhal'] = $template;
		$data['_baseurl'] = base_url();
		$data['_script'] = "";
		// $data['_content']=$this->_ci->load->view(''.$template,$data,TRUE);
		$arr = $this->parseContent($template, $data);
		$data = array_merge($data, $arr);
		
		$this->_ci->load->view('template/admin.php',$data);
	}


	/**
	 * Get the value of withKT
	 */ 
	public function getWithKT()
	{
		return $this->withKT;
	}

	/**
	 * Set the value of withKT
	 *
	 * @return  self
	 */ 
	public function setWithKT($withKT)
	{
		$this->withKT = $withKT ? true : false;

		return $this;
	}

	/**
	 * Get the value of withPenyidik
	 */ 
	public function getWithPenyidik()
	{
		return $this->withPenyidik;
	}

	/**
	 * Set the value of withPenyidik
	 *
	 * @return  self
	 */ 
	public function setWithPenyidik($withPenyidik)
	{
		$this->withPenyidik = $withPenyidik ? true : false;

		return $this;
	}
}

/* End of file template.php */
/* Location: ./application/libraries/template.php */