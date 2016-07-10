<?php
/* Module Test cases generated on: 2016-07-10 09:59:44 : 1468115984*/
App::import('Model', 'Module');

class ModuleTestCase extends CakeTestCase {
	var $fixtures = array('app.module', 'app.user', 'app.user_module');

	function startTest() {
		$this->Module =& ClassRegistry::init('Module');
	}

	function endTest() {
		unset($this->Module);
		ClassRegistry::flush();
	}

}
