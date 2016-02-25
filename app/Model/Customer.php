<?php
App::uses('AppModel', 'Model');
/**
 * Customer Model
 *
 * @property User $User
 * @property Employee $Employee
 * @property Deal $Deal
 * @property Feedback $Feedback
 * @property Guidance $Guidance
 * @property Ctype $Ctype
 * @property Ptype $Ptype
 * @property Suburb $Suburb
 * @property Wy $Wy
 */
class Customer extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Deal' => array(
			'className' => 'Deal',
			'foreignKey' => 'customer_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Feedback' => array(
			'className' => 'Feedback',
			'foreignKey' => 'customer_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Guidance' => array(
			'className' => 'Guidance',
			'foreignKey' => 'customer_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Ctype' => array(
			'className' => 'Ctype',
			'joinTable' => 'ctypes_customers',
			'foreignKey' => 'customer_id',
			'associationForeignKey' => 'ctype_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Ptype' => array(
			'className' => 'Ptype',
			'joinTable' => 'customers_ptypes',
			'foreignKey' => 'customer_id',
			'associationForeignKey' => 'ptype_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Suburb' => array(
			'className' => 'Suburb',
			'joinTable' => 'customers_suburbs',
			'foreignKey' => 'customer_id',
			'associationForeignKey' => 'suburb_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Wy' => array(
			'className' => 'Wy',
			'joinTable' => 'customers_wys',
			'foreignKey' => 'customer_id',
			'associationForeignKey' => 'wy_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
