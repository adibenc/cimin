<?php

// use CiLeo\BaseModel as CiLeoBaseModel;
// use CiLeo\BaseModelTrait;

// class AppBaseModel extends CiLeoBaseModel{
class AppBaseModel extends CI_Model{
	use CiLeo\BaseModelTrait;

	function __construct() {
		parent::__construct();
	}
}