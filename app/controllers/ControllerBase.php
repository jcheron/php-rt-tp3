<?php
namespace controllers;
use Ubiquity\utils\http\URequest;
use Ubiquity\controllers\Controller;

/**
 * ControllerBase
 **/
abstract class ControllerBase extends Controller{

	public function initialize(){
		if(!URequest::isAjax()){
			$this->loadView("main/vHeader.html");
		}
	}

	public function finalize(){
		if(!URequest::isAjax()){
			$this->loadView("@framework/main/vFooter.html");
		}
	}
	
	public function message($type,$header,$body,$icon="info"){
		return $this->loadView("message.html",get_defined_vars(),true);
	}
}
