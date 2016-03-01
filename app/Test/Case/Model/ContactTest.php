<?php
App::uses('Contact', 'Model');

/**
 * Contact Test Case
 *
 */
class ContactTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.contact',
		'app.customer',
		'app.user',
		'app.employee',
		'app.team',
		'app.article',
		'app.suburb',
		'app.customers_suburb',
		'app.property',
		'app.deal',
		'app.lawyer',
		'app.wy',
		'app.customers_wy',
		'app.ptype',
		'app.customers_ptype',
		'app.properties_ptype',
		'app.plan',
		'app.summary',
		'app.feedback',
		'app.guidance',
		'app.ctype',
		'app.ctypes_customer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Contact = ClassRegistry::init('Contact');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contact);

		parent::tearDown();
	}

}
