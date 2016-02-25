<?php
App::uses('Ctype', 'Model');

/**
 * Ctype Test Case
 *
 */
class CtypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ctype',
		'app.ctype_customer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ctype = ClassRegistry::init('Ctype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ctype);

		parent::tearDown();
	}

}
