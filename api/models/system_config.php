<?php
class SystemConfig extends AppModel {
	var $name = 'SystemConfig';
	var $useTable = false;
	function getRefNo(){
		return rand();
	}
}