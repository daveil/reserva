<?php
/* TextMessage Test cases generated on: 2016-11-06 19:06:53 : 1478430413*/
App::import('Model', 'TextMessage');

class TextMessageTestCase extends CakeTestCase {
	var $fixtures = array('app.text_message');

	function startTest() {
		$this->TextMessage =& ClassRegistry::init('TextMessage');
	}

	function endTest() {
		unset($this->TextMessage);
		ClassRegistry::flush();
	}

}
