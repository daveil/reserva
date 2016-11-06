<?php
/* TextMessage Fixture generated on: 2016-11-06 19:06:53 : 1478430413 */
class TextMessageFixture extends CakeTestFixture {
	var $name = 'TextMessage';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mobile_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 12, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'message' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 420, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 'Lorem ipsum dolor sit amet',
			'mobile_number' => 'Lorem ipsu',
			'message' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-11-06 19:06:53'
		),
	);
}
