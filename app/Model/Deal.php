<?php
App::uses('AppModel', 'Model');
/**
 * Deal Model
 *
 * @property Property $Property
 * @property Customer $Customer
 * @property Employee $Employee
 * @property Lawer $Lawer
 * @property Wy $Wy
 */
class Deal extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'property_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'customer_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'employee_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Property' => array(
			'className' => 'Property',
			'foreignKey' => 'property_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
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
		),
		'Lawer' => array(
			'className' => 'Lawer',
			'foreignKey' => 'lawer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Wy' => array(
			'className' => 'Wy',
			'foreignKey' => 'wy_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
