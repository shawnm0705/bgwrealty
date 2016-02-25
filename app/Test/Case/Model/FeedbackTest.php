<?php
App::uses('Feedback', 'Model');

/**
 * Feedback Test Case
 *
 */
class FeedbackTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.feedback',
		'app.customer',
		'app.user',
		'app.employee',
		'app.deal',
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
		$this->Feedback = ClassRegistry::init('Feedback');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Feedback);

		parent::tearDown();
	}

}
