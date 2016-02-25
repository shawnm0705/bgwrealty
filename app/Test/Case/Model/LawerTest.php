<?php
App::uses('Lawer', 'Model');

/**
 * Lawer Test Case
 *
 */
class LawerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.lawer',
		'app.deal',
		'app.customer',
		'app.user',
		'app.employee',
		'app.feedback',
		'app.guidance',
		'app.customers_lawer',
		'app.suburb',
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
		$this->Lawer = ClassRegistry::init('Lawer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Lawer);

		parent::tearDown();
	}

}
