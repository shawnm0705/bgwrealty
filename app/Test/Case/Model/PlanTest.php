<?php
App::uses('Plan', 'Model');

/**
 * Plan Test Case
 *
 */
class PlanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.plan',
		'app.employee',
		'app.user',
		'app.team',
		'app.article',
		'app.customer',
		'app.deal',
		'app.property',
		'app.lawer',
		'app.customers_lawer',
		'app.wy',
		'app.customers_wy',
		'app.feedback',
		'app.guidance',
		'app.suburb',
		'app.customers_suburb',
		'app.summary'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Plan = ClassRegistry::init('Plan');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Plan);

		parent::tearDown();
	}

}
