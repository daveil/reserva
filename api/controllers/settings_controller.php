<?php
class SettingsController extends AppController {

	var $name = 'Settings';

	function index() {
		$this->Setting->recursive = 0;
		$this->set('settings', $this->paginate());
		if($this->RequestHandler->isAjax()){
			$data = array();
			$clinic_days = array();
			foreach($this->paginate() as $s){
				$id = $s['Setting']['id'];
				$value = $s['Setting']['value'];
				switch($id){
					case 'CLINIC_DAYS':
						$clinic_days = explode(',',$value);
						$data[$id]=array();
						foreach(array('SUN','MON','TUE','WED','THU','FRI','SAT') as $day){
							$data[$id][$day]=in_array($day,$clinic_days);
						}
					break;
					case 'REF_NO_COUNTER':
					case 'MAX_DAILY_BOOKING':
					case 'HOUR_START':
					case 'HOUR_END':
						$data[$id]=(int)$value;
					break;
					default:
						$data[$id]=$value;
					break;
				}
			}
			if(isset($_GET['clinic_sched'])){
				$sched = array();
				$sched['days'] = $clinic_days;
				$clinic_hours=array();
				for($h=$data['HOUR_START'];$h<=$data['HOUR_END'];$h++){
						$hr = ($h%12);
						if($h%12==0)
							$hr='12';
						else if($h%12<10&&$h!=0) 
							$hr ='0'. $hr;
						$am = $h>=12?'PM':'AM';
						$hr30 = $hr.':30 '.$am; 
						$hr = $hr.':00 '.$am; 
						$hour = array('id'=>$h.':00','name'=>$hr);
						array_push($clinic_hours,$hour);
						$hour = array('id'=>$h.':30','name'=>$hr30);
						array_push($clinic_hours,$hour);
					
				}
				$sched['hours'] = $clinic_hours;
				$data =  $sched;
			}
			echo json_encode($data);exit;
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid setting', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('setting', $this->Setting->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Setting->create();
			if ($this->Setting->save($this->data)) {
				$this->Session->setFlash(__('The setting has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		sleep(1);
		if($this->RequestHandler->isAjax()){
			$settings =  $this->ajaxInput;
			foreach($settings as $id=>$value){
				if($id=='CLINIC_DAYS'){
					$days = array();
					foreach($value as $day=>$flag){
						if($flag)
							array_push($days,$day);
					}
					$value = implode(',',$days);
				}
				$config = array('id'=>$id,'value'=>$value);
				$this->Setting->save($config);
				$this->Setting->buildCache();
			}
			echo json_encode($settings);exit;
		}else{
			if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid setting', true));
			$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->data)) {
				if ($this->Setting->save($this->data)) {
					$this->Session->setFlash(__('The setting has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The setting could not be saved. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Setting->read(null, $id);
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for setting', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Setting->delete($id)) {
			$this->Session->setFlash(__('Setting deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Setting was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function truncate(){
		$queries = array();
		array_push($queries,"TRUNCATE TABLE `appointments`");
		array_push($queries,"TRUNCATE TABLE `disabled_dates`");
		array_push($queries,"TRUNCATE TABLE `patients`");
		array_push($queries,"TRUNCATE TABLE `text_messages`");
		array_push($queries,"DELETE FROM   `users` WHERE `type`!='admin'");
		echo '<pre>';
		foreach($queries as $q){
			echo 'Executing: '.$q.'<br/>';
			$this->Setting->query($q);
		}
		exit;
			
	}
}
