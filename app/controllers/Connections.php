<?php
namespace controllers;
use controllers\crud\datas\ConnectionsDatas;
use Ubiquity\controllers\crud\CRUDDatas;
use controllers\crud\viewers\ConnectionsViewer;
use Ubiquity\controllers\admin\viewers\ModelViewer;
use controllers\crud\events\ConnectionsEvents;
use Ubiquity\controllers\crud\CRUDEvents;
use controllers\crud\files\ConnectionsFiles;
use Ubiquity\controllers\crud\CRUDFiles;

 /**
 * CRUD Controller Connections
 **/
class Connections extends \Ubiquity\controllers\crud\CRUDController{
	
	public function __construct(){
		parent::__construct();
		$this->model="models\\Connection";
	}

	public function _getBaseRoute() {
		return 'Connections';
	}
	
	protected function getAdminData(): CRUDDatas{
		return new ConnectionsDatas($this);
	}

	protected function getModelViewer(): ModelViewer{
		return new ConnectionsViewer($this);
	}

	protected function getEvents(): CRUDEvents{
		return new ConnectionsEvents($this);
	}

	protected function getFiles(): CRUDFiles{
		return new ConnectionsFiles();
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\crud\CRUDController::_getInstancesFilter()
	 */
	public function _getInstancesFilter($model) {
		return "1=1 order by idUser DESC,dateCo DESC";
	}



}
