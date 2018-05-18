<?php
namespace controllers;
 use Ubiquity\orm\DAO;

 /**
 * Controller Users
 * @property \Ajax\php\ubiquity\JsUtils $jquery
 **/
class Users extends ControllerBase{

	public function index(){
		
	}

	public function display($idUser){
		$user=DAO::getOne("models\\User", $idUser,true);
		DAO::getManyToMany($user, "groupes");
		$de=$this->jquery->semantic()->dataElement("user-element", $user);
		$de->setFields(["firstname","lastname","email","suspended","organization","groupes"]);
		$de->setCaptions(["Firstname","Lastname","Email","Suspended?","Organization","Groupes"]);
		$de->fieldAsCheckbox("suspended",["disabled"=>"disabled"]);
		$de->fieldAsLabel("email","mail",["jsCallback"=>function($elm,$instance){
			$elm->addContent("@".$instance->getOrganization()->getDomain());
			return $elm;
		}]);
		$de->fieldAsList("groupes","animated ordered");
		$this->jquery->getHref("a.edit",null,["ajaxTransition"=>"random"]);
		$this->jquery->renderDefaultView(["user"=>$user]);
	}

}
