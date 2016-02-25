<?php
App::uses('Summary', 'Model');

/**
 * Summary Test Case
 *
 */
class SummaryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.summary',
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
		'app.plan'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Summary = ClassRegistry::init('Summary');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Summary);

		parent::tearDown();
	}

}
