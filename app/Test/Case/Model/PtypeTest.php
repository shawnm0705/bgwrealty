<?php
App::uses('Ptype', 'Model');

/**
 * Ptype Test Case
 *
 */
class PtypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ptype',
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
		'app.plan',
		'app.summary',
		'app.feedback',
		'app.guidance',
		'app.ctype',
		'app.ctypes_customer',
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
		$this->Ptype = ClassRegistry::init('Ptype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ptype);

		parent::tearDown();
	}

}
