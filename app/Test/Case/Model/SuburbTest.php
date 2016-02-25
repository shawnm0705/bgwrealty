<?php
App::uses('Suburb', 'Model');

/**
 * Suburb Test Case
 *
 */
class SuburbTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.suburb',
		'app.article',
		'app.customer',
		'app.user',
		'app.employee',
		'app.deal',
		'app.feedback',
		'app.guidance',
		'app.lawer',
		'app.customers_lawer',
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
		$this->Suburb = ClassRegistry::init('Suburb');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Suburb);

		parent::tearDown();
	}

}
