<?php
App::uses('Employee', 'Model');

/**
 * Employee Test Case
 *
 */
class EmployeeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.plan',
		'app.summary'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Employee = ClassRegistry::init('Employee');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Employee);

		parent::tearDown();
	}

}
