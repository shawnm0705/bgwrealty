<?php
App::uses('Customer', 'Model');

/**
 * Customer Test Case
 *
 */
class CustomerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.customer',
		'app.user',
		'app.employee',
		'app.team',
		'app.article',
		'app.suburb',
		'app.customers_suburb',
		'app.property',
		'app.deal',
		'app.lawer',
		'app.wy',
		'app.customers_wy',
		'app.ptype',
		'app.customers_ptype',
		'app.properties_ptype',
		'app.plan',
		'app.summary',
		'app.feedback',
		'app.guidance',
		'app.ctype',
		'app.ctypes_customer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Customer = ClassRegistry::init('Customer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Customer);

		parent::tearDown();
	}

}
