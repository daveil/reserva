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
				$paginate['conditions']=$conditions;
				$this->paginate = $paginate;
				$appointments =  array();
				foreach($this->paginate() as $p){
					$appointment = array(
						'id'=>$p['Patient']['id'],
						'ref_no'=>$p['Appointment']['ref_no'],
						'name'=>$p['Patient']['name'],
						'concern'=>$p['Appointment']['concern'],
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
				$this->Session->setFlash(__('The appointment has been saved', true));
				if($this->RequestHandler->isAjax()){
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
					$appointment['message']='Could not save appointment';
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
					$appointments = $input['appointments'];
					$schedule = $input['schedule'];
					$results =array('error'=>0,'success'=>0,'schedule'=>$schedule);
					foreach($appointments as $ref_no){
						 $updated = $this->Appointment->updateAll(
							array('Appointment.schedule'=>"'".$schedule."'"),
							array('Appointment.ref_no'=>$ref_no)
						);
						 if($updated){
						 	$results['success']++;
						 }else{
						 	$results['error']++;
						 }
					}
					$response = array();
					$response['data'] = $results;
					if($results['error']>0){
						 $response['message']='Some appointments were not saved';
					}else{
						 $response['message']='Changes has been saved';
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
}
