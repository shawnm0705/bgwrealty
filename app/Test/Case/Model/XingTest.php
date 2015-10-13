<?php
App::uses('Xing', 'Model');

/**
 * Xing Test Case
 *
 */
class XingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.xing',
		'app.medicine',
		'app.position',
		'app.guijing',
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
		$this->Xing = ClassRegistry::init('Xing');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Xing);

		parent::tearDown();
	}

}
