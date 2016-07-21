<?php
/* Setting Fixture generated on: 2016-07-21 14:58:23 : 1469084303 */
class SettingFixture extends CakeTestFixture {
	var $name = 'Setting';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1', 'key' => 'primary'),
		'value' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 140, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array(),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 'Lorem ip',
			'value' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-07-21 14:58:23',
			'modified' => '2016-07-21 14:58:23'
		),
	);
}
