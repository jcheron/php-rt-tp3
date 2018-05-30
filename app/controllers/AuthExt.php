<?php
namespace controllers;
use controllers\auth\files\AuthExtFiles;
use Ubiquity\controllers\auth\AuthFiles;

 /**
 * Auth Controller AuthExt
 **/
class AuthExt extends \controllers\BaseAuth{

	public function _getBaseRoute() {
		return 'AuthExt';
	}
	
	protected function getFiles(): AuthFiles{
		return new AuthExtFiles();
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
	 * @see \Ubiquity\controllers\auth\AuthController::badLoginMessage()
	 */
	protected function badLoginMessage(\Ubiquity\utils\flash\FlashMessage $fMessage) {
		$fMessage->setTitle("Erreur d'authentification");
		$fMessage->setContent("Login ou mot de passe incorrects !");
		$this->_setLoginCaption("Essayer à nouveau");
	}

	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::disconnectedMessage()
	 */
	protected function disconnectedMessage(\Ubiquity\utils\flash\FlashMessage $fMessage) {
		// TODO Auto-generated method stub
		
	}

	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::noAccessMessage()
	 */
	protected function noAccessMessage(\Ubiquity\utils\flash\FlashMessage $fMessage) {
		$fMessage->setTitle("Accès interdit");
		$fMessage->setContent("Vous devez vous connecter pour accéder à la page <b>{url}</b> !");
		$this->_setLoginCaption("Se connecter");	
	}

	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::terminateMessage()
	 */
	protected function terminateMessage(\Ubiquity\utils\flash\FlashMessage $fMessage) {
		$fMessage->setTitle("Déconnexion");
		$fMessage->setContent("Vous avez été correctement déconnecté de l'application.");
		$this->_setLoginCaption("Se connecter à nouveau");
		$fMessage->setIcon("smile outline");
		
	}
	
	public function _getBodySelector() {
		return "#body";
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::attemptsNumber()
	 */
	protected function attemptsNumber() {
		return 3;
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::_checkConnectionTimeout()
	 */
	public function _checkConnectionTimeout() {
		return 10000;
	}



	
	

}
