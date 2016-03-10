<?php
App::uses('Deal', 'Model');

/**
 * Deal Test Case
 *
 */
class DealTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.deal',
		'app.customer',
		'app.user',
		'app.employee',
		'app.team',
		'app.article',
		'app.suburb',
		'app.customers_suburb',
		'app.property',
		'app.ptype',
		'app.customers_ptype',
		'app.properties_ptype',
		'app.plan',
		'app.summary',
		'app.feedback',
		'app.guidance',
		'app.ctype',
		'app.ctypes_customer',
		'app.wy',
		'app.customers_wy'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Deal = ClassRegistry::init('Deal');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Deal);

		parent::tearDown();
	}

}
