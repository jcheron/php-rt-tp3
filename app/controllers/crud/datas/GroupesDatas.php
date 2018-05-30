<?php
namespace controllers\crud\datas;

use Ubiquity\controllers\crud\CRUDDatas;
 /**
 * Class Groupes_Datas
 **/
class GroupesDatas extends CRUDDatas{
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\crud\CRUDDatas::getFieldNames()
	 */
	public function getFieldNames($model) {
		return ["name","email"];
	}
}
