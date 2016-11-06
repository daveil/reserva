<?php
/* TextMessages Test cases generated on: 2016-11-06 19:07:14 : 1478430434*/
App::import('Controller', 'TextMessages');

class TestTextMessagesController extends TextMessagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TextMessagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.text_message');

	function startTest() {
		$this->TextMessages =& new TestTextMessagesController();
		$this->TextMessages->constructClasses();
	}

	function endTest() {
		unset($this->TextMessages);
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
