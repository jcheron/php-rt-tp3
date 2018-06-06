<?php
namespace controllers;
use Ubiquity\controllers\Startup;
use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;
use Ubiquity\orm\DAO;
use models\Connection;

 /**
 * Auth Controller BaseAuth
 **/
class BaseAuth extends \Ubiquity\controllers\auth\AuthController{

	protected function onConnect($connected) {
		$urlParts=$this->getOriginalURL();
		USession::set($this->_getUserSessionKey(), $connected);
		
		if(isset($urlParts)){
			$url=implode("/",$urlParts);
			Startup::forward($url);
		}else{
			$url="organizations/display/".$connected->getOrganization()->getId();
			$this->forward("controllers\\Organizations","display",[$connected->getOrganization()->getId()],true,true);
		}
		$connection=new Connection();
		$connection->setUser($connected);
		$connection->setUrl($url);
		$connection->setDateCo(date('Y-m-d H:i:s'));
		DAO::save($connection);
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
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::toCookie()
	 */
	protected function toCookie($connected) {
		return md5($connected->getId());
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::fromCookie()
	 */
	protected function fromCookie($cookie){
		return DAO::getOne("models\\User", "md5(id)='{$cookie}'");
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::rememberCaption()
	 */
	protected function rememberCaption() {
		return "Se souvenir de moi";
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::passwordLabel()
	 */
	protected function passwordLabel() {
		return "Mot de passe";
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::attemptsNumberMessage()
	 */
	protected function attemptsNumberMessage(\Ubiquity\utils\flash\FlashMessage $fMessage, $attempsCount) {
		if($attempsCount>0)
			$fMessage->setContent("Il vous reste {_attemptsCount} tentatives de connexion.");
		else{
			$fMessage->setContent("Il ne vous reste plus aucune tentative de connexion, prochaîne tentative dans {_timer} secondes");	
			}
	}



	
	

}
