<?php 
namespace Flux\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Flux\Model\Flux;
 use Flux\Model\FluxTable;
 use Flux\Form\FluxForm;
 
 class FluxController extends AbstractActionController
 {
     protected $fluxTable;
     
     public function indexAction()
     {
         return new ViewModel(array(
         		'fluxV' => $this->getFluxTable()->fetchAll(),
         ));
     }

     public function addAction()
     {
         $form = new FluxForm();
         $form->get('submit')->setValue('Add');
         
         $request = $this->getRequest();
         if ($request->isPost()) {
         	$flux = new Flux();
         	$form->setInputFilter($flux->getInputFilter());
         	$form->setData($request->getPost());
         
         	if ($form->isValid()) {
         		$album->exchangeArray($form->getData());
         		$this->getFluxTable()->saveFlux($flux);
         
         		// Redirect to list of albums
         		return $this->redirect()->toRoute('flux');
         	}
         }
         return array('form' => $form);
     }

     
     
     public function editAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
         	return $this->redirect()->toRoute('flux', array(
         			'action' => 'add'
         	));
         }
         
         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
         	$flux = $this->getFluxTable()->getFlux($id);
         }
         catch (\Exception $ex) {
         	return $this->redirect()->toRoute('flux', array(
         			'action' => 'index'
         	));
         }
         
         $form  = new FluxForm();
         $form->bind($flux);
         $form->get('submit')->setAttribute('value', 'Edit');
         
         $request = $this->getRequest();
         if ($request->isPost()) {
         	$form->setInputFilter($flux->getInputFilter());
         	$form->setData($request->getPost());
         
         	if ($form->isValid()) {
         		$this->getFluxTable()->saveFlux($flux);
         
         		// Redirect to list of albums
         		return $this->redirect()->toRoute('flux');
         	}
         }
         
         return array(
         		'id' => $id,
         		'form' => $form,
         );
     }

     public function deleteAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
         	return $this->redirect()->toRoute('flux');
         }
         
         $request = $this->getRequest();
         if ($request->isPost()) {
         	$del = $request->getPost('del', 'No');
         
         	if ($del == 'Yes') {
         		
         		$id = (int) $request->getPost('id');
         		
         		$this->getFluxTable()->deleteFlux($id);
         	}
         
         	// Redirect to list of albums
         	return $this->redirect()->toRoute('flux');
         }
         
         return array(
         		'id'    => $id,
         		'flux' => $this->getFluxTable()->getFlux($id)
         );
     }
     
     
     public function getFluxTable()
     {
         
     	if (!$this->fluxTable) {
     		$sm = $this->getServiceLocator();
     		$this->fluxTable = $sm->get('Flux\Model\FluxTable');
     	}
     	return $this->fluxTable;
     }
 }
 
 ?>