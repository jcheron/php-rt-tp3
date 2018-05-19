<?php
namespace controllers;

use Ubiquity\utils\http\URequest;
use controllers\auth\files\AuthCtrlFiles;
use Ubiquity\controllers\auth\AuthFiles;
use Ubiquity\utils\http\USession;

 /**
 * Auth Controller AuthCtrl
 **/
class AuthCtrl extends BaseAuth{

	public function initialize(){
		if(!URequest::isAjax()){
			$this->loadView("main/vHeader.html");
		}
	}
	
	public function _getBaseRoute() {
		return 'AuthCtrl';
	}
	
	protected function getFiles(): AuthFiles{
		return new AuthCtrlFiles();
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::badLoginMessage()
	 */
	protected function badLoginMessage(\Ubiquity\utils\flash\FlashMessage $fMessage) {
		$fMessage->setContent("Login ou mot de passe incorrect");
		$fMessage->setType("error");
		$fMessage->setTitle("Erreur de connexion");
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::_displayInfoAsString()
	 */
	public function _displayInfoAsString() {
		return true;
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\Controller::loadView()
	 */
	public function loadView($viewName, $pData = NULL, $asString = false) {
		$this->jquery->getHref("a.ajax");
		$this->jquery->compile($this->view);
		return parent::loadView ($viewName,$pData,$asString);
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::_getBodySelector()
	 */
	public function _getBodySelector() {
		return "#body";
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::_checkConnectionTimeout()
	 */
	public function _checkConnectionTimeout() {
		return 30000;
	}
	/**
	 * {@inheritDoc}
	 * @see \controllers\BaseAuth::_isValidUser()
	 */
	public function _isValidUser() {
		$valid=parent::_isValidUser ();
		if($valid && $this->_action=="display" && $this->_controller=="controllers\Organizations"){
			$user=USession::get($this->_getUserSessionKey());
			$valid=$user->getOrganization()->getId()==$this->_actionParams[0];
			if(!$valid){
				$this->_setNoAccessMsg("Vous n'appartenez pas à cette organisation","Accès non autorisé");
				$this->_setLoginCaption("Se connecter avec un autre compte");
				$bt=$this->jquery->semantic()->htmlButton("btReturn","Retourner à la page précédente");
				$bt->onClick("window.history.go(-1); return false;");
			}
		}
		return $valid;
	}



}
