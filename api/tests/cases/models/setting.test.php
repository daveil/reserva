<?php
/* Setting Test cases generated on: 2016-07-21 14:58:23 : 1469084303*/
App::import('Model', 'Setting');

class SettingTestCase extends CakeTestCase {
	var $fixtures = array('app.setting');

	function startTest() {
		$this->Setting =& ClassRegistry::init('Setting');
	}

	function endTest() {
		unset($this->Setting);
		ClassRegistry::flush();
	}

}
