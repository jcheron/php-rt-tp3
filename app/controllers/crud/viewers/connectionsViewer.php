<?php
namespace controllers\crud\viewers;

use Ubiquity\controllers\admin\viewers\ModelViewer;
use Ajax\semantic\widgets\datatable\DataTable;
 /**
 * Class ConnectionsViewer
 **/
class ConnectionsViewer extends ModelViewer{
	/**
	 * Définition des en-têtes de colonnes
	 */
	public function getCaptions($captions, $className) {
		return ["Date connexion","Url"];
	}

	/**
	 * Regroupement par utilisateur (champ 0) et affichage en bouton
	 */
	protected function getDataTableInstance($instances, $model, $page = 1): DataTable {
		$dt= parent::getDataTableInstance ($instances,$model,$page);
		$dt->setGroupByFields([0]);
		$dt->fieldAsButton(0,"basic red",["jsCallback"=>function($bt,$instance){$bt->setProperty("data-user",$instance->getUser()->getId());$bt->addIcon("remove");}]);
		$dt->setEdition ( true );
		return $dt;
	}

	/**
	 * Affichage du seul bouton pour Supprimer
	 */
	protected function getDataTableRowButtons() {
		return ["delete"];
	}

	/**
	 * Pas d'affichage du détail sur clic d'un élément
	 */
	public function showDetailsOnDataTableClick() {
		return false;
	}
	/**
	 * Pas de pagination
	 */
	public function recordsPerPage($model, $totalCount = 0) {
		return;
	}
}
