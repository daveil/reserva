<?php
class UserModulesController extends AppController {

	var $name = 'UserModules';

	function index() {
		$this->UserModule->recursive = 0;
		$this->set('userModules', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user module', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userModule', $this->UserModule->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UserModule->create();
			if ($this->UserModule->save($this->data)) {
				$this->Session->setFlash(__('The user module has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user module could not be saved. Please, try again.', true));
			}
		}
		$users = $this->UserModule->User->find('list');
		$modules = $this->UserModule->Module->find('list');
		$this->set(compact('users', 'modules'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user module', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserModule->save($this->data)) {
				$this->Session->setFlash(__('The user module has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user module could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserModule->read(null, $id);
		}
		$users = $this->UserModule->User->find('list');
		$modules = $this->UserModule->Module->find('list');
		$this->set(compact('users', 'modules'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user module', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UserModule->delete($id)) {
			$this->Session->setFlash(__('User module deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User module was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
