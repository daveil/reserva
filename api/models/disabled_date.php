<?php
class DisabledDate extends AppModel {
	var $name = 'DisabledDate';
	function getDates($date){
		$month = date("m",strtotime($date));
		$fields = array('DisabledDate.date');
		$conditions = array('MONTH(DisabledDate.date)'=>$month );
		$results = $this->find('all',compact('fields','conditions'));
		$dates = array();
		foreach($results as $r){
			array_push($dates,$r['DisabledDate']['date']);
		}
		return $dates;
	}
}
