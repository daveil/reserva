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
						$data[$id]=(int)$value;
					break;
					default:
						$data[$id]=$value;
					break;
				}
			}
			if(isset($_GET['clinic_days'])){
				$data = $clinic_days;
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
}
