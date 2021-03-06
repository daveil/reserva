<?php
class Setting extends AppModel {
	var $name = 'Setting';
	function getRefNo(){
		$setting = $this->findById('REF_NO_COUNTER');
		$refNo = (int)$setting['Setting']['value'];
		return $refNo;
	}
	function setRefNo($value){
		$setting = array();
		$setting['Setting']=array(
				'id'=>'REF_NO_COUNTER',
				'value'=>(int)$value
		);
		return $this->save($setting);
	}
	function getMaxDailyBooking(){
		$setting = $this->findById('MAX_DAILY_BOOKING');
		$max = (int)$setting['Setting']['value'];
		return $max;
	}
	
	function buildCache(){
		$fields = array('Setting.id','Setting.value');
		$settings = $this->find('list',compact('fields'));
		$settings = json_encode($settings);
		file_put_contents(ROOT.DS.'views'.DS.'cache'.DS.'settings.json',$settings);
	}
	function getChikkaCreds(){
		$fields = array('Setting.id','Setting.value');
		$conditions = array('Setting.id LIKE'=>'CHIKKA_%');
		return $this->find('list',compact('conditions','fields'));
	}
}
