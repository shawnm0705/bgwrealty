<?php
App::uses('Wei', 'Model');

/**
 * Wei Test Case
 *
 */
class WeiTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.wei',
		'app.medicine',
		'app.xing',
		'app.position',
		'app.guijing',
		'app.guijings_medicine',
		'app.medicines_wei'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Wei = ClassRegistry::init('Wei');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Wei);

		parent::tearDown();
	}

}
