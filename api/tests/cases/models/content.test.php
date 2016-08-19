<?php
/* Content Test cases generated on: 2016-08-19 10:10:28 : 1471572628*/
App::import('Model', 'Content');

class ContentTestCase extends CakeTestCase {
	var $fixtures = array('app.content');

	function startTest() {
		$this->Content =& ClassRegistry::init('Content');
	}

	function endTest() {
		unset($this->Content);
		ClassRegistry::flush();
	}

}
