<?php
/* DisabledDates Test cases generated on: 2016-08-23 20:15:07 : 1471954507*/
App::import('Controller', 'DisabledDates');

class TestDisabledDatesController extends DisabledDatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DisabledDatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.disabled_date');

	function startTest() {
		$this->DisabledDates =& new TestDisabledDatesController();
		$this->DisabledDates->constructClasses();
	}

	function endTest() {
		unset($this->DisabledDates);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
