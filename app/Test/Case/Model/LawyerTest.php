<?php
App::uses('Lawyer', 'Model');

/**
 * Lawyer Test Case
 *
 */
class LawyerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.lawyer',
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
		'app.customers_wy'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Lawyer = ClassRegistry::init('Lawyer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Lawyer);

		parent::tearDown();
	}

}
