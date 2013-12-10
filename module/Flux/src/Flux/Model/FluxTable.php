<?php
namespace Flux\Model;

use Zend\Db\TableGateway\TableGateway;

class FluxTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getFlux($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}

	public function saveFlux(Flux $flux)
	{
		$data = array(
				'artist' => $flux->artist,
				'title'  => $flux->title,
		);

		$id = (int) $flux->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getFlux($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Flux id does not exist');
			}
		}
	}

	public function deleteFlux($id)
	{
		$this->tableGateway->delete(array('id' => (int) $id));
	}
}