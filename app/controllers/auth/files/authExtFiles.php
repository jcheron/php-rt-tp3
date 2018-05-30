<?php
namespace controllers\auth\files;

use Ubiquity\controllers\auth\AuthFiles;
 /**
 * Class AuthExtFiles
 **/
class AuthExtFiles extends AuthFiles{
	public function getViewInfo(){
		return "AuthExt/info.html";
	}
	
	public function getBaseTemplate(){
		return "base.html";
	}
}
