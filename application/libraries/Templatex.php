<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//

class Template{
	
	protected $_ci;
	
	function __construct()
	{
		$this->_ci =&get_instance();
	}
	
	function display($template,$data=null)
	{		
		$data['cekhal'] = $template;
		$data['_include']=$this->_ci->load->view('template/include',$data,TRUE);
		$data['_header']=$this->_ci->load->view('template/header',$data,TRUE);
		$data['_content']=$this->_ci->load->view(''.$template,$data,TRUE);
		$data['_footer']=$this->_ci->load->view('template/footer',$data,TRUE);
		
		$this->_ci->load->view('template/template.php',$data);
	}

}

/* End of file template.php */
/* Location: ./application/libraries/template.php */