<?php
return array(
		'controllers' => array(
				'invokables' => array(
						'Flux\Controller\Flux' => 'Flux\Controller\FluxController',
				),
		),
		//
		// The following section is new and should be added to your file
		'router' => array(
				'routes' => array(
						'flux' => array(
								'type'    => 'segment',
								'options' => array(
										'route'    => '/flux[/][:action][/:id]',
										'constraints' => array(
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id'     => '[0-9]+',
										),
										'defaults' => array(
												'controller' => 'Flux\Controller\Flux',
												'action'     => 'index',
										),
								),
						),
				),
		),
		
		'view_manager' => array(
				'template_path_stack' => array(
						'flux' => __DIR__ . '/../view',
				),
		),
		);