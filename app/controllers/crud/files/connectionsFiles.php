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


}
