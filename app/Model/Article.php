<?php
App::uses('AppModel', 'Model');
/**
 * Article Model
 *
 * @property Suburb $Suburb
 * @property Property $Property
 * @property Employee $Employee
 */
class Article extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Suburb' => array(
			'className' => 'Suburb',
			'foreignKey' => 'suburb_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Property' => array(
			'className' => 'Property',
			'foreignKey' => 'property_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Employee' => array(
			'className' => 'Employee',
			'foreignKey' => 'employee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
