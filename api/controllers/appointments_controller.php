<?php
class AppointmentsController extends AppController {

	var $name = 'Appointments';
	var $uses = array('Appointment','DisabledDate');
	function index() {
		$this->Appointment->recursive = 0;
		if($this->RequestHandler->isAjax()){
			$data =array();
			if(isset($_GET['schedule'])){
				$schedule = date('Y-m-d',strtotime($_GET['schedule']));
				$conditions = array('Appointment.schedule'=>$schedule);	
				$records = $this->Appointment->find('all',compact('conditions'));
				$appointments =  array();
				foreach($records as $p){
					$appointment = array(
						'id'=>$p['Patient']['id'],
						'aid'=>$p['Appointment']['id'],
						'ref_no'=>$p['Appointment']['ref_no'],
						'name'=>$p['Patient']['name'],
						'concern'=>$p['Appointment']['concern'],
						'status'=>$p['Appointment']['status'],
					);
					array_push($appointments,$appointment);
				}
				$data['status'] =  $this->DisabledDate->getStatus($schedule);
				$data['appointments']=$appointments;
			}else if(isset($_GET['bookings'])){
				$bookings = $_GET['bookings'];
				$full= $this->DisabledDate->getDates($bookings);
				$book= $this->Appointment->getDates($bookings);
				$data = compact('full','book');
			}else if(isset($_GET['history'])){
				$this->Appointment->recursive=-1;
				$history =  $this->Appointment->findAllByPatientId($_SESSION['user']['patient_id']);
				$data = $history;
			}
			echo json_encode($data);exit;
		}else{
			$this->set('appointments', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid appointment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('appointment', $this->Appointment->read(null, $id));
	}

	function add() {
		if($this->RequestHandler->isAjax()){
			$input = file_get_contents('php://input');
			header('Content-Type: application/json');
			$this->data = json_decode($input,true);
		}
		if (!empty($this->data)) {
			$this->Appointment->create();
			$appointment =  array();
			if ($this->Appointment->saveAll($this->data)) {
				$schedule = $this->data['Appointment']['schedule'];
				$isDateFull = !$this->Appointment->checkAvailability($schedule);
				if($isDateFull){
					$this->DisabledDate->setDate($schedule,'full');
				}
				$this->Session->setFlash(__('The appointment has been saved', true));
				if($this->RequestHandler->isAjax()){
					$_SESSION['user']['patient']=$this->data['Patient'];
					$appointment['status']='OK';
					$appointment['data']=$this->Appointment->findById($this->Appointment->id);
					$appointment['message']='Mabuhay! Appointment saved.';
					echo json_encode($appointment);exit;
				}else{
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($input){
					$appointment['status']='ERROR';
					$appointment['message']='Could not save appointment. Date full.';
					echo json_encode($appointment);exit;
				}else{
					$this->Session->setFlash(__('The appointment could not be saved. Please, try again.', true));
				}
			}
		}
		$patients = $this->Appointment->Patient->find('list');
		$this->set(compact('patients'));
	}

	function edit($id = null) {

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid appointment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {

			if($this->RequestHandler->isAjax()){
				if($this->ajaxInput){
					header('Content-Type: application/json');
					$input =$this->ajaxInput;
					if(isset($_GET['sched'])){
						$appointments = $input['appointments'];
						$schedule = $input['schedule'];
						$results =array('error'=>0,'success'=>0,'schedule'=>$schedule);
						$invalids = array();
						foreach($appointments as $ref_no){
							 $currentAppointment = $this->Appointment->findByRefNo($ref_no);
							 $isAvailable = $this->Appointment->checkAvailability($schedule);
							 $results['isAvailable'] = $isAvailable;
							 if($isAvailable){
								$updated = $this->Appointment->updateAll(
									array('Appointment.schedule'=>"'".$schedule."'"),
									array('Appointment.ref_no'=>$ref_no)
								); 
								$prevSched =  $currentAppointment['Appointment']['schedule'];
								$isPrevAvail = $this->Appointment->checkAvailability($prevSched);
								if($isPrevAvail){
									$this->DisabledDate->setDate($prevSched,'enabled');
								}
								$currSched = $schedule;
								$isCurrAvail = $this->Appointment->checkAvailability($currSched);
								$this->DisabledDate->setDate($currSched,$isCurrAvail?'enabled':'full');
							 }else{
								 $updated = false;
							 }
							 if($updated){
								$results['success']++;
							 }else{
								array_push($invalids,$ref_no);
								$results['error']++;
							 }
						}
						$response = array();
						$response['data'] = $results;
						if($results['error']>0){
							 $response['status']='ERROR';
							 $response['message']='Could not save appointment ref no(s):'.implode(', ',$invalids).'. Date selected is full';
						}else{
							$response['status']='OK';
							 $response['message']='Changes has been saved';
						}
					}else if(isset($_GET['status'])){
						$response = array();
						$data = array('Appointment'=>$input);
						$response['data'] =$data;
						if($this->Appointment->save($data)){
							$response['status']='OK';
							$response['message']='Changes has been saved';
						}
					}else if(isset($_GET['history'])){
						$response = array();
						if(isset($input['schedule']))
							$input['status']='upcoming';
						$data = array('Appointment'=>$input);
						
						$response['data'] =$data;
						if($this->Appointment->save($data)){
							$response['status']='OK';
							$response['message']='Changes has been saved';
						}else{
							$response['status']='ERROR';
							$response['message']='Could not save changes';
						}
					}
					echo json_encode($response);exit;
				}
			}else{
				if ($this->Appointment->save($this->data)) {
					$this->Session->setFlash(__('The appointment has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The appointment could not be saved. Please, try again.', true));
				}
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Appointment->read(null, $id);
		}
		$patients = $this->Appointment->Patient->find('list');
		$this->set(compact('patients'));
	}

	function delete($id = null) {
		if($this->RequestHandler->isAjax()){
			if($this->ajaxInput){
				header('Content-Type: application/json');
				$input =$this->ajaxInput;
				$ref_nos = $input['appointments'];
				$results =array('error'=>0,'success'=>0);
				 $deleted = $this->Appointment->deleteAll(
					array('Appointment.ref_no'=>$ref_nos)
				);
				 if($deleted){
				 	$results['success']++;
				 }else{
				 	$results['error']++;
				 }
				$response = array();
				$response['data'] = $results;
				if($results['error']>0){
					 $response['message']='Could not delete appointments';
				}else{
					 $response['message']='Appointmens has been delete';
				}
				echo json_encode($response);exit;
			}
		}else{
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for appointment', true));
				$this->redirect(array('action'=>'index'));
			}
			if ($this->Appointment->delete($id)) {
				$this->Session->setFlash(__('Appointment deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Appointment was not deleted', true));
			$this->redirect(array('action' => 'index'));
		}
	}
	function report(){
		if(isset($_GET['ids']) && isset($_GET['date'])){
			$ids =  explode(',',$_GET['ids']);
			$date =  $_GET['date'];
			$conditions = array('Appointment.ref_no'=>$ids,'Appointment.schedule'=>$date);
			$appointments = $this->Appointment->find('all',compact('conditions'));
			$this->layout=null;
			$this->set(compact('appointments'));
		}
		
	}
	function ref_no(){
		$appointment = $this->Appointment->findById($_GET['id']);
		$this->layout=null;
		$this->set(compact('appointment'));
	}
}