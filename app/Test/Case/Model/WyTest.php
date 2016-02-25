<?php
App::uses('Wy', 'Model');

/**
 * Wy Test Case
 *
 */
class WyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.wy',
		'app.deal',
		'app.customer',
		'app.user',
		'app.employee',
		'app.feedback',
		'app.guidance',
		'app.lawer',
		'app.customers_lawer',
		'app.suburb',
		'app.customers_suburb',
		'app.customers_wy'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Wy = ClassRegistry::init('Wy');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Wy);

		parent::tearDown();
	}

}
