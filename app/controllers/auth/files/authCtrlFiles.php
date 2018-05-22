<?php
namespace controllers\auth\files;

use Ubiquity\controllers\auth\AuthFiles;
 /**
 * Class AuthCtrlFiles
 **/
class AuthCtrlFiles extends AuthFiles{

	public function getViewIndex(){
		return "AuthCtrl/index.html";
	}
	
	public function getViewInfo(){
		return "AuthCtrl/info.html";
	}
	
	public function getViewNoAccess(){
		return "AuthCtrl/noAccess.html";
	}
	
	public function getBaseTemplate(){
		return "base.html";
	}
	
}
