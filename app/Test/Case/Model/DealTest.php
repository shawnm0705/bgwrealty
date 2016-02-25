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
		'app.customer',
		'app.user',
		'app.employee',
		'app.feedback',
		'app.guidance',
		'app.lawer',
		'app.customers_lawer',
		'app.suburb',
		'app.article',
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
