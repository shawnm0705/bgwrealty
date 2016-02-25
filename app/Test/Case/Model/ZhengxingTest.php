<?php
App::uses('Zhengxing', 'Model');

/**
 * Zhengxing Test Case
 *
 */
class ZhengxingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.zhengxing',
		'app.consultation',
		'app.patient',
		'app.doctor',
		'app.zhenduan'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Zhengxing = ClassRegistry::init('Zhengxing');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Zhengxing);

		parent::tearDown();
	}

}
