<?php
namespace controllers;
 use Ubiquity\orm\DAO;

 /**
 * Controller Organizations
 **/
class Organizations extends \Ubiquity\controllers\ControllerBase{

	public function index(){
		$organizations=DAO::getAll("models\\Organization");
		$this->loadView("Organizations/index.html",["orgas"=>$organizations]);
	}
	
	public function display($idOrga){
		$orga=DAO::getOne("models\\Organization", $idOrga,true,true);
		$this->loadView("Organizations/display.html",["orga"=>$orga]);
	}
}
