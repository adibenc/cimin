<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(__DIR__.'/BaseController.php');

class C1 extends BaseController {
	function __construct()
	{
		parent:: __construct();
		//todo
	}

	public function index()
	{
		echo "index";
	}
	
	public function mapRedir($k){
		$m = json_decode( file_get_contents(APPPATH."/dmy-url.json") , true);
		$url = $m[$k];
		// to url
		header("Location: $url");
		// redirect($url);
	}
}