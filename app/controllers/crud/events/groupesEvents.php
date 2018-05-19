<?php
namespace controllers\crud\events;

use Ubiquity\controllers\crud\CRUDEvents;
 /**
 * Class GroupesEvents
 **/
class GroupesEvents extends CRUDEvents{
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\crud\CRUDEvents::beforeLoadView()
	 */
	public function beforeLoadView($viewName, &$vars) {
		$vars["orga"]=$this->controller->_getActiveUser()->getOrganization();
		
	}

	//use override/implement Methods
}
