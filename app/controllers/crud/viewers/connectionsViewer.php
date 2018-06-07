<?php
namespace controllers\crud\viewers;

use Ubiquity\controllers\admin\viewers\ModelViewer;
use Ajax\semantic\widgets\datatable\DataTable;
use Ajax\semantic\html\elements\HtmlLabel;
use Ubiquity\utils\base\UDateTime;
 /**
 * Class ConnectionsViewer
 **/
class ConnectionsViewer extends ModelViewer{
	/**
	 * Définition des en-têtes de colonnes
	 */
	public function getCaptions($captions, $className) {
		return ["Quand ?","URL (point d'entrée)"];
	}

	/**
	 * Modification de l'affichage des champs
	 */
	protected function getDataTableInstance($instances, $model, $page = 1): DataTable {
		$dt= parent::getDataTableInstance ($instances,$model,$page);
		$dt->fieldAsButton(0,"basic red",["jsCallback"=>function($bt,$instance){
			$bt->setProperty("data-user",$instance->getUser()->getId());
			$bt->addIcon("remove");
		}]);
		$dt->fieldAsLabel(2,'linkify',["addClass"=>"basic fluid"]);
		$dt->setValueFunction(1,function($value,$instance){
			$lbl=new HtmlLabel("dateCo-".$instance->getId(),UDateTime::elapsed($value),"clock");
			$lbl->addPopup("",UDateTime::longDatetime($value,"fr"));
			return $lbl;
		});
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
		return 5;
	}
	/**
	 * Regroupement suivant le champ en position 0 (user)
	 */
	public function getGroupByFields() {
		return [0];
	}

}
