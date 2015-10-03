<?php
App::uses('Poemtagcate', 'Model');

/**
 * Poemtagcate Test Case
 *
 */
class PoemtagcateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.poemtagcate',
		'app.poemtag',
		'app.poem',
		'app.poems_poemtag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Poemtagcate = ClassRegistry::init('Poemtagcate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Poemtagcate);

		parent::tearDown();
	}

}
