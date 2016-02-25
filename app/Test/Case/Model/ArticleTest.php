<?php
App::uses('Article', 'Model');

/**
 * Article Test Case
 *
 */
class ArticleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.article',
		'app.suburb',
		'app.customer',
		'app.user',
		'app.employee',
		'app.team',
		'app.deal',
		'app.property',
		'app.lawer',
		'app.customers_lawer',
		'app.wy',
		'app.customers_wy',
		'app.plan',
		'app.summary',
		'app.feedback',
		'app.guidance',
		'app.customers_suburb'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Article = ClassRegistry::init('Article');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Article);

		parent::tearDown();
	}

}
