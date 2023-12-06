<?php

include_once(__DIR__."/Views/FilterBuilder.php");

class ViewFactory{
	static function create($t){
		switch($t){
			case "fb1":
				return (new FilterBuilder());
				// ->set_role($_role);
			break;
		}
	}
}