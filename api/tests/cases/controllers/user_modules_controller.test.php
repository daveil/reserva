<?php
/* UserModules Test cases generated on: 2016-07-10 09:59:56 : 1468115996*/
App::import('Controller', 'UserModules');

class TestUserModulesController extends UserModulesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UserModulesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.user_module', 'app.user', 'app.module');

	function startTest() {
		$this->UserModules =& new TestUserModulesController();
		$this->UserModules->constructClasses();
	}

	function endTest() {
		unset($this->UserModules);
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
