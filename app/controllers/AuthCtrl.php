<?php
namespace controllers;
use Ubiquity\controllers\Startup;
use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;
use controllers\auth\files\AuthCtrlFiles;
use Ubiquity\controllers\auth\AuthFiles;
use Ubiquity\orm\DAO;

 /**
 * Auth Controller AuthCtrl
 **/
class AuthCtrl extends \Ubiquity\controllers\auth\AuthController{

	public function initialize(){
		if(!URequest::isAjax()){
			$this->loadView("main/vHeader.html");
		}
	}
	
	protected function onConnect($connected) {
		$urlParts=$this->getOriginalURL();
		USession::set($this->_getUserSessionKey(), $connected);
		if(isset($urlParts)){
			Startup::forward(implode("/",$urlParts));
		}else{
			$this->forward("controllers\\Organizations","display",[$connected->getOrganization()->getId()],true,true);
		}
	}
	
	protected function _connect() {
		if(URequest::isPost()){
			$email=URequest::post($this->_getLoginInputName());
			$password=URequest::post($this->_getPasswordInputName());
			$user=DAO::getOne("models\\User", "email='{$email}'");
			if(isset($user) && $user->getPassword()==$password){
				return $user;
			}
		}
		return;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::isValidUser()
	 */
	public function _isValidUser() {
		return USession::exists($this->_getUserSessionKey());
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
		return false;
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

	
	

}
