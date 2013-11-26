<?php
namespace Flux\Model;

class Flux
{
	public $id_gentile;
	public $nom_gentile;
	public $auteur;

	public function exchangeArray($data)
	{
		$this->id_gentile = (!empty($data['id_gentile'])) ? $data['id_gentile'] : null;
		$this->nom_gentile = (!empty($data['nom_gentile'])) ? $data['nom_gentile'] : null;
		$this->auteur  = (!empty($data['auteur'])) ? $data['auteur'] : null;
	}
}



