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
		'app.property',
		'app.article',
		'app.suburb',
		'app.customer',
		'app.user',
		'app.employee',
		'app.team',
		'app.plan',
		'app.summary',
		'app.feedback',
		'app.guidance',
		'app.ctype',
		'app.ctypes_customer',
		'app.ptype',
		'app.customers_ptype',
		'app.properties_ptype',
		'app.customers_suburb',
		'app.wy',
		'app.customers_wy',
		'app.lawyer'
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
