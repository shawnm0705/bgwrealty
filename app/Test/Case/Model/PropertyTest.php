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
