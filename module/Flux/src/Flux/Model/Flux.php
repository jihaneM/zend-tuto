<?php 
namespace Flux\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

 class Flux implements InputFilterAwareInterface
 {
     public $id;
     public $artist;
     public $title;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->artist = (!empty($data['artist'])) ? $data['artist'] : null;
         $this->title  = (!empty($data['title'])) ? $data['title'] : null;
     }
     
     
     
     public function getArrayCopy()
     {
     	return get_object_vars($this);
     }
     
     
     
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
     	throw new \Exception("Not used");
     }
     
     
     
     public function getInputFilter()
     {
     	
     	if (!$this->p) {
     		$p = new InputFilter();
     
     		$p->add(array(
     				'name'     => 'id',
     				'required' => true,
     				'filters'  => array(
     						array('name' => 'Int'),
     				),
     		));
     
     		$p->add(array(
     				'name'     => 'artist',
     				'required' => true,
     				'filters'  => array(
     						array('name' => 'StripTags'),
     						array('name' => 'StringTrim'),
     				),
     				'validators' => array(
     						array(
     								'name'    => 'StringLength',
     								'options' => array(
     										'encoding' => 'UTF-8',
     										'min'      => 1,
     										'max'      => 100,
     								),
     						),
     				),
     		));
     
     		$p->add(array(
     				'name'     => 'title',
     				'required' => true,
     				'filters'  => array(
     						array('name' => 'StripTags'),
     						array('name' => 'StringTrim'),
     				),
     				'validators' => array(
     						array(
     								'name'    => 'StringLength',
     								'options' => array(
     										'encoding' => 'UTF-8',
     										'min'      => 1,
     										'max'      => 100,
     								),
     						),
     				),
     		));
     
     		$this->p = $p;
     	}
     
     	return $this->p;
     }
    
 }
 
 ?>