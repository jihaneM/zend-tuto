<?php
namespace Flux\Model;

class Score
{
	public $id_score;
	public $nombredepoint;
	

	public function exchangeArray($data)
	{
		$this->id_score     = (!empty($data['id_score'])) ? $data['id_score'] : null;
		$this->nombredepoint = (!empty($data['nombredepoint'])) ? $data['nombredepoint'] : null;
	
	}
}
