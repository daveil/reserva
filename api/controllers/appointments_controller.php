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
			$schedule = $this->data['Appointment']['schedule'];
			$timeslot = $this->data['Appointment']['timeslot'];
			$check = $this->Appointment->checkAvailability($schedule,$timeslot);
			if ($this->Appointment->saveAll($this->data)) {
				if(array_search('full',$check['status'])){
					$this->DisabledDate->setDate($schedule,'full');
				}
				$this->Session->setFlash(__('The appointment has been saved', true));
				if($this->RequestHandler->isAjax()){
					$_SESSION['user']['patient']=$this->data['Patient'];
					$appointment['status']='OK';
					$appointment['data']=$this->Appointment->findById($this->Appointment->id);
					$appointment['message']='Mabuhay! Appointment saved.';
					$appointment['check']=$check;
					$pid =  $this->data['Patient']['id'];
					$details = array('ref_no'=>$appointment['data']['Appointment']['ref_no'],'sched'=>$schedule.' '.$timeslot);
					$this->notifyChanges($pid,'save_appointment',$details);
					echo json_encode($appointment);exit;
				}else{
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($input){
					$appointment['status']='ERROR';
					$appointment['message']='Could not save appointment.';
					$appointment['check']=$check;
					foreach($check['status'] as $key){
						switch($key){
							case 'full':
								$appointment['message'].=' Date is full.';
							break;
							case 'occupied_timeslot':
								$appointment['message'].=' Time slot is occupied.';
							break;
							case 'similar_appointment':
								$appointment['message'].=' Similar appointment.';
							break;
						}
					}
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
						$changes = array();
						foreach($appointments as $aid){
							 $currentAppointment = $this->Appointment->findById($aid);
							 $ref_no =  $currentAppointment['Appointment']['ref_no'];
							 $timeslot =  $currentAppointment['Appointment']['timeslot'];
							 $patient_id =  $currentAppointment['Appointment']['patient_id'];
							 $check = $this->Appointment->checkAvailability($schedule,$timeslot,$patient_id);
							 $results['isAvailable'] = $check['available'];
							 if($check['available']){
								$updated = $this->Appointment->updateAll(
									array('Appointment.schedule'=>"'".$schedule."'"),
									array('Appointment.id'=>$aid)
								); 
								$prevSched =  $currentAppointment['Appointment']['schedule'];
								$prevTime =  $currentAppointment['Appointment']['timeslot'];
								$prevPID =  $currentAppointment['Appointment']['patient_id'];
								$isPrevAvail = $this->Appointment->checkAvailability($prevSched,$prevTime,$prevPID);
								if($isPrevAvail['available']){
									$this->DisabledDate->setDate($prevSched,in_array('full',$check['status'])?'full':'enabled');
								}
								$currSched = $schedule;
								$currTime = $prevTime;
								$currPID = $prevPID;
								$isCurrAvail = $this->Appointment->checkAvailability($currSched,$currTime,$currPID);
								$this->DisabledDate->setDate($currSched,in_array('full',$isCurrAvail['status'])?'full':'enabled');
								$changes[$patient_id]=array('ref_no'=>$ref_no,'prev'=>$prevSched,'curr'=>$currSched,'time'=>$currTime);
							 }else{
								 $updated = false;
							 }
							 if($updated){
								$results['success']++;
							 }else{
								array_push($invalids,$aid);
								$results['error']++;
							 }
						}
						$response = array();
						$response['data'] = $results;
						if($results['error']>0){
							 $response['status']='ERROR';
							 $response['message']='Could not save appointment ref no(s):'.implode(', ',$invalids).'. Date selected is unavailable';
						}else{
							$response['check']=$check;
							$response['isCurrAvail']=$isCurrAvail;
							$response['status']='OK';
							 $response['message']='Changes has been saved';
							 $debug=array();
							 foreach($changes as $pid=>$details){
								$notif=$this->notifyChanges($pid,'move_appointment',$details);
								array_push($debug,$notif);
							 }
							 $response['debug']=$debug;
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
	protected function notifyChanges($pid,$action,$details){
		$patient = $this->Appointment->Patient->findById($pid);
		switch($action){
			case 'save_appointment':
				$ref_no = $details['ref_no'];
				$sched = date('M d, Y h:i A',strtotime($details['sched']));
				$subject = "Appointment Reserved";
				$message = "Thank you! Your appointment with ref no $ref_no is reserved on $sched";
				$email = $patient['User']['email']; 
				$mobile = '63'.$patient['Patient']['contact_no'];
				$this->Appointment->Patient->User->sendEmail($email,$subject,$message);
				$this->Appointment->Patient->User->sendSMS($mobile,$message);
			break;
			case 'move_appointment':
				$ref_no = $details['ref_no'];
				$curr = date('M d, Y',strtotime($details['curr']));
				$prev = date('M d',strtotime($details['prev']));
				$time = date('h:i A',strtotime($details['time']));
				$subject = "Appointment Changes";
				$message = "Your appointment with Ref No: $ref_no was moved from $prev to $curr $time";
				$email = $patient['User']['email'];
				$mobile = '63'.$patient['Patient']['contact_no'];
				$this->Appointment->Patient->User->sendEmail($email,$subject,$message);
				$this->Appointment->Patient->User->sendSMS($mobile,$message);
				return array('email'=>$email,'mobile'=>$mobile);
			break;
		}
		
	}
}