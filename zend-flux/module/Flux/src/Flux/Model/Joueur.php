<?php
namespace Flux\Model;

class Joueur
{
	public $id_joueur;
	public $login;
	public $email;
	public $pays;

	public function exchangeArray($data)
	{
		$this->id_joueur     = (!empty($data['id_id_joueur'])) ? $data['id_id_joueur'] : null;
		$this->login = (!empty($data['login'])) ? $data['login'] : null;
		$this->email  = (!empty($data['email'])) ? $data['email'] : null;
		$this->pays = (!empty($data['pays'])) ? $data['pays'] : null;
	}
}