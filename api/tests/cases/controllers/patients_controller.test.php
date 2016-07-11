<?php
/* Patients Test cases generated on: 2016-07-10 09:59:56 : 1468115996*/
App::import('Controller', 'Patients');

class TestPatientsController extends PatientsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PatientsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.patient', 'app.appointment');

	function startTest() {
		$this->Patients =& new TestPatientsController();
		$this->Patients->constructClasses();
	}

	function endTest() {
		unset($this->Patients);
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
