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
}