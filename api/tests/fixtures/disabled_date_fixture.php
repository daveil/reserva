<?php
/* DisabledDate Fixture generated on: 2016-08-23 20:14:30 : 1471954470 */
class DisabledDateFixture extends CakeTestFixture {
	var $name = 'DisabledDate';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'status' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'date' => '2016-08-23',
			'status' => 'Lorem ip',
			'created' => '2016-08-23 20:14:30',
			'modified' => '2016-08-23 20:14:30'
		),
	);
}
