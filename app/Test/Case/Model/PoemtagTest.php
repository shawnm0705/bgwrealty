<?php
App::uses('Poemtag', 'Model');

/**
 * Poemtag Test Case
 *
 */
class PoemtagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.poemtag',
		'app.poemtagcate',
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
		$this->Poemtag = ClassRegistry::init('Poemtag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Poemtag);

		parent::tearDown();
	}

}
