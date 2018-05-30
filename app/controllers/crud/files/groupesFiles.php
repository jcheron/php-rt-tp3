<?php
namespace controllers\crud\files;

use Ubiquity\controllers\crud\CRUDFiles;
 /**
 * Class GroupesFiles
 **/
class GroupesFiles extends CRUDFiles{
	public function getViewForm(){
		return "Groupes/form.html";
	}
	public function getViewDisplay(){
		return "Groupes/display.html";
	}

	public function getViewIndex() {
		return "Groupes/index.html";
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\crud\CRUDFiles::getBaseTemplate()
	 */
	public function getBaseTemplate() {
		return "base.html";
	}

}
