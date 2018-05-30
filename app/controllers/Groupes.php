<?php
namespace controllers;
use controllers\crud\viewers\GroupesViewer;
use Ubiquity\controllers\admin\viewers\ModelViewer;
use controllers\crud\events\GroupesEvents;
use Ubiquity\controllers\crud\CRUDEvents;
use controllers\crud\files\GroupesFiles;
use Ubiquity\controllers\crud\CRUDFiles;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;
use Ubiquity\utils\http\URequest;
use controllers\crud\datas\GroupesDatas;
use Ubiquity\controllers\crud\CRUDDatas;

 /**
 * CRUD Controller Groupes
 **/
class Groupes extends \Ubiquity\controllers\crud\CRUDController{
	use WithAuthTrait{
		initialize as _initializeAuth;
	}

	public function initialize(){
		$this->_initializeAuth();
		if(!URequest::isAjax()){
			$this->loadView("main/vHeader.html");
		}
	}
	
	public function __construct(){
		parent::__construct();
		$this->model="models\\Groupe";
	}

	public function _getBaseRoute() {
		return 'Groupes';
	}
	
	protected function getAdminData(): CRUDDatas{
		return new GroupesDatas($this);
	}
	
	protected function getModelViewer(): ModelViewer{
		return new GroupesViewer($this);
	}
	
	protected function getEvents(): CRUDEvents{
		return new GroupesEvents($this);
	}
	
	protected function getFiles(): CRUDFiles{
		return new GroupesFiles();
	}
	
	protected function getAuthController(): AuthController {
		return new AuthExt();
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\crud\CRUDController::_getInstancesFilter()
	 */
	public function _getInstancesFilter($model) {
		return "idOrganization=".$this->_getAuthController()->_getActiveUser()->getOrganization()->getId();
	}
	
	public function _getActiveUser(){
		return $this->_getAuthController()->_getActiveUser();
	}
}
