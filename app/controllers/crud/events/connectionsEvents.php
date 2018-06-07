<?php
namespace controllers\crud\events;

use Ubiquity\controllers\crud\CRUDEvents;
use Ubiquity\controllers\crud\CRUDMessage;
use Ubiquity\orm\DAO;
 /**
 * Class ConnectionsEvents
 **/
class ConnectionsEvents extends CRUDEvents{
	/**
	 * Appelé après affichage des objets (refresh ou index)
	 * Ajout de l'appel de deleteAll sur le click du bouton user
	 */
	public function onDisplayElements() {
		$this->controller->jquery->getOnClick(".ui.button[data-user]",$this->controller->_getBaseRoute()."/deleteAll/","#table-messages",["attr"=>"data-user"]);
	}

	/**
	 * Modifie le message de confirmation en cas de suppression multiple
	 */
	public function onConfDeleteMultipleMessage(\Ubiquity\controllers\crud\CRUDMessage $message, $data): CRUDMessage {
		$user=DAO::getOne("models\\User", $data);
		$message->setMessage("Confirmez vous la suppression des connexions de l'utilisateur `<b>" . $user . "</b>`?");
		$message->setTitle("Confirmation avant suppression");
		return $message;
	}

	/**
	 * Modifie le message post suppression multiple
	 */
	public function onSuccessDeleteMultipleMessage(\Ubiquity\controllers\crud\CRUDMessage $message): CRUDMessage {
		$message->setMessage("Suppression de {count} enregistrement(s)");
		$message->setTitle("Suppression");
		return $message;
	}
}
