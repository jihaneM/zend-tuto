<?php
namespace Flux;

// Add these import statements:
use Flux\Model\Flux;
use Flux\Model\FluxTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module{
		
			public function getAutoloaderConfig(){
					return array(
							'Zend\Loader\ClassMapAutoloader' => array(
									__DIR__ . '/autoload_classmap.php',
							),
							'Zend\Loader\StandardAutoloader' => array(
									'namespaces' => array(
											__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
									),
							),
					);
			}
			
			public function getConfig(){
					return include __DIR__ . '/config/module.config.php';
			}
			
     public function getServiceConfig()
     {
         return array(
             'factories' => array(
                     'Flux\Model\FluxTable' =>  function($sm) {
                     $tableGateway = $sm->get('FluxTableGateway');
                     $table = new FluxTable($tableGateway);
                     return $table;
                 },
                     'FluxTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype -> setArrayObjectPrototype(new Flux());
                     return new TableGateway('flux', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }