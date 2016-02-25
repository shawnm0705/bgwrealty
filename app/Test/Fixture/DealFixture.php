<?php
/**
 * DealFixture
 *
 */
class DealFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'unitno' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'property_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'employee_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'lawer_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'wy_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id', 'property_id', 'customer_id', 'employee_id'), 'unique' => 1),
			'fk_deals_properties1_idx' => array('column' => 'property_id', 'unique' => 0),
			'fk_deals_customers1_idx' => array('column' => 'customer_id', 'unique' => 0),
			'fk_deals_employees1_idx' => array('column' => 'employee_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'unitno' => 'Lorem ipsum dolor sit amet',
			'status' => 'Lorem ipsum dolor sit amet',
			'property_id' => 1,
			'customer_id' => 1,
			'employee_id' => 1,
			'lawer_id' => 1,
			'wy_id' => 1
		),
	);

}
