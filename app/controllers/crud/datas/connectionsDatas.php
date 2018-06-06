<?php
namespace controllers\crud\datas;

use Ubiquity\controllers\crud\CRUDDatas;
 /**
 * Class ConnectionsDatas
 **/
class ConnectionsDatas extends CRUDDatas{
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\crud\CRUDDatas::getFieldNames()
	 */
	public function getFieldNames($model) {
		return ["user","dateCo","url"];
	}
	//use override/implement Methods
}
