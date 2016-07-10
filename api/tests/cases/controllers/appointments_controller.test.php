<?php
/* Appointments Test cases generated on: 2016-07-10 09:59:56 : 1468115996*/
App::import('Controller', 'Appointments');

class TestAppointmentsController extends AppointmentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AppointmentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.appointment', 'app.patient');

	function startTest() {
		$this->Appointments =& new TestAppointmentsController();
		$this->Appointments->constructClasses();
	}

	function endTest() {
		unset($this->Appointments);
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
