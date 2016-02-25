<?php
App::uses('Consultation', 'Model');

/**
 * Consultation Test Case
 *
 */
class ConsultationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.consultation',
		'app.patient',
		'app.doctor',
		'app.zhenduan',
		'app.zhengxing'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Consultation = ClassRegistry::init('Consultation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Consultation);

		parent::tearDown();
	}

}
