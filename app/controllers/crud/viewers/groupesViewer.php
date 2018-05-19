<?php
namespace controllers\crud\viewers;

use Ubiquity\controllers\admin\viewers\ModelViewer;
use Ajax\semantic\widgets\datatable\DataTable;
 /**
 * Class GroupesViewer
 **/
class GroupesViewer extends ModelViewer{
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\admin\viewers\ModelViewer::getCaptions()
	 */
	public function getCaptions($captions, $className) {
		return ["Nom","Adresse email"];
	}

	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\admin\viewers\ModelViewer::getDataTableInstance()
	 */
	protected function getDataTableInstance($instances, $model, $page = 1): DataTable {
		$dt=parent::getDataTableInstance ($instances,$model,$page);
		$dt->fieldAsLabel(1,"users");
		return $dt;
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\admin\viewers\ModelViewer::getDataTableRowButtons()
	 */
	protected function getDataTableRowButtons() {
		return ["display","delete"];
	}
}
