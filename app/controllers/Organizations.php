<?php
namespace controllers;
use Ubiquity\orm\DAO;
use Ubiquity\utils\http\URequest;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;

 /**
 * Controller Organizations
 * @property \Ajax\php\ubiquity\JsUtils $jquery
 **/
class Organizations extends ControllerBase{
	use WithAuthTrait;
	
	public function index(){
		$organizations=DAO::getAll("models\\Organization");
		$this->jquery->renderView("Organizations/index.html",["orgas"=>$organizations]);
	}
	
	public function display($idOrga,$idGroupe=null){
		if(URequest::isAjax()){
			echo $this->users($idOrga,$idGroupe);
		}else{
			$orga=DAO::getOne("models\\Organization", $idOrga,true,true);
			if(isset($orga)){
				$users=$this->users($idOrga,$idGroupe,$orga->getUsers());
				$this->jquery->getHref("a.orga",null,["ajaxTransition"=>"random"]);
				$this->jquery->renderView("Organizations/display.html",["orga"=>$orga,"users"=>$users]);
			}else{
				$msg= $this->message("error", "Organization", "Organisation introuvable","warning circle");
				$this->jquery->renderDefaultView(["message"=>$msg]);
			}
		}
	}


	protected function users($idOrga,$idGroupe=null,$users=null){
		$messages="";
		if(isset($idGroupe)){
			$group=DAO::getOne("models\\Groupe",$idGroupe,true,true);
			if(isset($group)){
				if($group->getOrganization()->getId()==$idOrga){
					$title=$group->getName();
					$users=DAO::getManyToMany($group, "users");					
				}else{
					$message= $this->message("error", "Groupe", "Ce groupe n'appartient pas à l'organisation","warning circle");
					$users=[];
				}
			}else{
				$message= $this->message("error", "Groupe", "Groupe inexistant","warning circle");
				$users=[];
			}
		}else{
				$title="Tous les utilisateurs";
				if(!isset($users)){
					$users=DAO::getAll("models\\User","idOrganization=".$idOrga);
				}
		}
		$this->jquery->getHref("a.users",null,["ajaxTransition"=>"random"]);
		return $this->jquery->renderView("Organizations/users.html",compact("users","title","message"),true);
	}
	
	protected function getAuthController(): AuthController {
		return new AuthExt();
	}
}
