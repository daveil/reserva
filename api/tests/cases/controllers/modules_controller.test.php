<?php
/* Modules Test cases generated on: 2016-07-10 09:59:56 : 1468115996*/
App::import('Controller', 'Modules');

class TestModulesController extends ModulesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ModulesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.module', 'app.user', 'app.user_module');

	function startTest() {
		$this->Modules =& new TestModulesController();
		$this->Modules->constructClasses();
	}

	function endTest() {
		unset($this->Modules);
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
