<?php
App::uses('Poem', 'Model');

/**
 * Poem Test Case
 *
 */
class PoemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.poem',
		'app.poemcate',
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
		$this->Poem = ClassRegistry::init('Poem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Poem);

		parent::tearDown();
	}

}
