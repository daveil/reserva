<?php
class TextMessagesController extends AppController {

	var $name = 'TextMessages';

	function index() {
		$this->TextMessage->recursive = 0;
		$this->set('textMessages', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid text message', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('textMessage', $this->TextMessage->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TextMessage->create();
			if ($this->TextMessage->save($this->data)) {
				$this->Session->setFlash(__('The text message has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The text message could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid text message', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TextMessage->save($this->data)) {
				$this->Session->setFlash(__('The text message has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The text message could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TextMessage->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for text message', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TextMessage->delete($id)) {
			$this->Session->setFlash(__('Text message deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Text message was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
