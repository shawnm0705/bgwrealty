<?php
App::uses('Poemcate', 'Model');

/**
 * Poemcate Test Case
 *
 */
class PoemcateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.poemcate',
		'app.poem',
		'app.poemtag',
		'app.poemtagcate',
		'app.poems_poemtag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Poemcate = ClassRegistry::init('Poemcate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Poemcate);

		parent::tearDown();
	}

}
