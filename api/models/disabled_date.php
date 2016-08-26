<?php
class DisabledDate extends AppModel {
	var $name = 'DisabledDate';
	function getDates($date){
		$month = date("m",strtotime($date));
		$fields = array('DisabledDate.date');
		$statuses = array('full','disabled');
		$conditions = array(
				'MONTH(DisabledDate.date)'=>$month,
				'DisabledDate.status'=>$statuses
				);
		$results = $this->find('all',compact('fields','conditions'));
		$dates = array();
		foreach($results as $r){
			array_push($dates,$r['DisabledDate']['date']);
		}
		return $dates;
	}
	function getStatus($schedule){
		$statuses = array('full','disabled');
		$conditions = array(
				'DisabledDate.date'=>$schedule,
				'DisabledDate.status'=>$statuses
				);
		$count = $this->find('count',compact('conditions'));
		return $count==0;
	}
}
