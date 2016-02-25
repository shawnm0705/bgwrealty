<?php
App::uses('Guidance', 'Model');

/**
 * Guidance Test Case
 *
 */
class GuidanceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.guidance',
		'app.customer',
		'app.user',
		'app.employee',
		'app.deal',
		'app.feedback',
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
		$this->Guidance = ClassRegistry::init('Guidance');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Guidance);

		parent::tearDown();
	}

}
