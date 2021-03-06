<?php
App::uses('Property', 'Model');

/**
 * Property Test Case
 *
 */
class PropertyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.property',
		'app.article',
		'app.suburb',
		'app.customer',
		'app.user',
		'app.employee',
		'app.team',
		'app.deal',
		'app.lawer',
		'app.wy',
		'app.customers_wy',
		'app.plan',
		'app.summary',
		'app.feedback',
		'app.guidance',
		'app.customers_suburb',
		'app.ctype',
		'app.ctypes_customer',
		'app.ptype',
		'app.customers_ptype',
		'app.properties_ptype'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Property = ClassRegistry::init('Property');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Property);

		parent::tearDown();
	}

}
