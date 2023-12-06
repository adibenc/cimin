<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "c1";
$route['404_override'] = 'my404';

$route['l/(:any)'] = 'C1/mapRedir/$1';
