<?php
class DisabledDatesController extends AppController {

	var $name = 'DisabledDates';

	function index($date=null) {
		if($this->RequestHandler->isAjax()||1){
			$dates = $this->DisabledDate->getDates($date);
			echo json_encode($dates);exit;
		}else{
			$this->DisabledDate->recursive = 0;
			$this->set('disabledDates', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid disabled date', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('disabledDate', $this->DisabledDate->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DisabledDate->create();
			if ($this->DisabledDate->save($this->data)) {
				$this->Session->setFlash(__('The disabled date has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disabled date could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid disabled date', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DisabledDate->save($this->data)) {
				$this->Session->setFlash(__('The disabled date has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disabled date could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DisabledDate->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for disabled date', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DisabledDate->delete($id)) {
			$this->Session->setFlash(__('Disabled date deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Disabled date was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
