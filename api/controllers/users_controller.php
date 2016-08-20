<?php
class UsersController extends AppController {

	var $name = 'Users';

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if($this->RequestHandler->isAjax()){
			if($this->ajaxInput){
				header('Content-Type: application/json');
				$input =$this->ajaxInput;
				$input['password'] =  md5($input['password']);
				$user = array();
				if($this->User->findByUsername($input['username'])){
					$user['status']='ERROR';
					$user['message']='Username already taken.';
				}else{
					$this->User->save($input);
					$user['status']='OK';
					$user['data']=$this->User->findById($this->User->id);
					$user['message']='User saved.';
				}
				echo json_encode($user);exit;
			}
		}else{
			if (!empty($this->data)) {
				if ($this->User->save($this->data)) {
					$this->Session->setFlash(__('The user has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function login(){
		if($this->RequestHandler->isAjax()){
			if($this->ajaxInput){
				header('Content-Type: application/json');
				$input =$this->ajaxInput;
				$conditions = array(
					'User.username'=>$input['username'],
					'User.password'=>md5($input['password']),
				);
				$user  = $this->User->find('first',compact('conditions'));
				$response =array();
				if($user){
					unset($user['User']['password']);
					unset($user['User']['created']);
					unset($user['User']['modified']);
					$response['status']='OK';
					$response['data']=$user['User'];
					$response['message']='User logged in';
				}else{
					$response['status']='ERROR';
					$response['message']='User / password incorrect';
				}
				echo json_encode($response);exit;
			}
		}
	}
}
