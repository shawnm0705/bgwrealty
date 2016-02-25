<?php
App::uses('AppModel', 'Model');
/**
 * Ctype Model
 *
 * @property CtypeCustomer $CtypeCustomer
 */
class Ctype extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */

	public $hasAndBelongsToMany = array(
		'Customer' => array(
			'className' => 'Customer',
			'joinTable' => 'ctypes_customers',
			'foreignKey' => 'ctype_id',
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
