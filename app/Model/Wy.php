<?php
App::uses('AppModel', 'Model');
/**
 * Wy Model
 *
 * @property Deal $Deal
 * @property Customer $Customer
 */
class Wy extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'wys';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Deal' => array(
			'className' => 'Deal',
			'foreignKey' => 'wy_id',
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
		'Customer' => array(
			'className' => 'Customer',
			'joinTable' => 'customers_wys',
			'foreignKey' => 'wy_id',
			'associationForeignKey' => 'customer_id',
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
