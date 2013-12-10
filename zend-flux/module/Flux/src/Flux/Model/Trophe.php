<?php
namespace Flux\Model;

class Score
{
	public $id_trophe;
	


	public function exchangeArray($data)
	{
		$this->id_trophe    = (!empty($data['id_trophe'])) ? $data['id_trophe'] : null;
		

	}
}

