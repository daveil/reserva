<?php
class PatientsController extends AppController {

	var $name = 'Patients';

	function index() {
		
		$this->Patient->recursive = 1;
		$this->set('patients', $this->paginate());
		if($this->RequestHandler->isAjax()){
			if(isset($_GET['search'])){
				$name ='%'.$_GET['search'].'%';
				$conditions = array('Patient.name LIKE'=>$name);
				$paginate['conditions']=$conditions;
				$this->paginate = $paginate;
			}
			
			$data = $this->paginate();
			echo json_encode($data);exit;
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid patient', true));
			$this->redirect(array('action' => 'index'));
		}
		if($this->RequestHandler->isAjax()){
			$patient = $this->Patient->read(null, $id);
			echo json_encode($patient);exit;
		}else{
			$this->set('patient', $this->Patient->read(null, $id));	
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->Patient->create();
			if ($this->Patient->save($this->data)) {
				$this->Session->setFlash(__('The patient has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid patient', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Patient->save($this->data)) {
				$this->Session->setFlash(__('The patient has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patient could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Patient->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for patient', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Patient->delete($id)) {
			$this->Session->setFlash(__('Patient deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Patient was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
