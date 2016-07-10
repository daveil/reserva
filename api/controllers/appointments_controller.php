<?php
class AppointmentsController extends AppController {

	var $name = 'Appointments';

	function index() {
		$this->Appointment->recursive = 0;
		$this->set('appointments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid appointment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('appointment', $this->Appointment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Appointment->create();
			if ($this->Appointment->save($this->data)) {
				$this->Session->setFlash(__('The appointment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The appointment could not be saved. Please, try again.', true));
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
			if ($this->Appointment->save($this->data)) {
				$this->Session->setFlash(__('The appointment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The appointment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Appointment->read(null, $id);
		}
		$patients = $this->Appointment->Patient->find('list');
		$this->set(compact('patients'));
	}

	function delete($id = null) {
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
