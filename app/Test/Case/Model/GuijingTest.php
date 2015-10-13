<?php
App::uses('Guijing', 'Model');

/**
 * Guijing Test Case
 *
 */
class GuijingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.guijing',
		'app.medicine',
		'app.xing',
		'app.position',
		'app.guijings_medicine',
		'app.wei',
		'app.medicines_wei'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Guijing = ClassRegistry::init('Guijing');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Guijing);

		parent::tearDown();
	}

}
