<?php
namespace Flux\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

 class FluxController extends AbstractActionController
 {
 	
 	protected $fluxTable;
 	
	 	public function getAlbumTable()
	 	{
	 	
	 		if (!$this->fluxTable) {
	 			$sm = $this->getServiceLocator();
	 			$this->fluxTable = $sm->get('Flux\Model\FluxTable');
	 		}
	 		return $this->fluxTable;
	 	}
	 	
	 	public function indexAction()
	 	{
	 		return new ViewModel(array(
	 				'fluxV' => $this->getAlbumTable()->fetchAll(),
	 		));
	 	}
 	 
 	
     

     public function addAction()
     {
     }

     public function editAction()
     {
     }

     public function deleteAction()
     {
     }
     
  
     
     
     
     
     
 }