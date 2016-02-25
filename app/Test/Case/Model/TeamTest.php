<?php
App::uses('Team', 'Model');

/**
 * Team Test Case
 *
 */
class TeamTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.team',
		'app.employee',
		'app.user',
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
		$this->Team = ClassRegistry::init('Team');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Team);

		parent::tearDown();
	}

}
