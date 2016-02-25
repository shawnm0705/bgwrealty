<?php
App::uses('Zhenduan', 'Model');

/**
 * Zhenduan Test Case
 *
 */
class ZhenduanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.zhenduan',
		'app.consultation',
		'app.patient',
		'app.doctor',
		'app.zhengxing'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Zhenduan = ClassRegistry::init('Zhenduan');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Zhenduan);

		parent::tearDown();
	}

}
