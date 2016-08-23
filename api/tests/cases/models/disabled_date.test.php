<?php
/* DisabledDate Test cases generated on: 2016-08-23 20:14:30 : 1471954470*/
App::import('Model', 'DisabledDate');

class DisabledDateTestCase extends CakeTestCase {
	var $fixtures = array('app.disabled_date');

	function startTest() {
		$this->DisabledDate =& ClassRegistry::init('DisabledDate');
	}

	function endTest() {
		unset($this->DisabledDate);
		ClassRegistry::flush();
	}

}
