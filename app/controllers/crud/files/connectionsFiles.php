<?php
namespace controllers\crud\files;

use Ubiquity\controllers\crud\CRUDFiles;
 /**
 * Class ConnectionsFiles
 **/
class ConnectionsFiles extends CRUDFiles{
	public function getViewIndex(){
		return "Connections/index.html";
	}
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\crud\CRUDFiles::getViewBaseTemplate()
	 */
	public function getBaseTemplate() {
		return "base.html";
	}
}
