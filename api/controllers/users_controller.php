<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $uses = array('User','Patient');
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
				$response = array();
				if($this->User->findByUsername($input['username'])){
					$response['status']='ERROR';
					$response['message']='Username already taken.';
				}else{
					$patient =  array(
								'name'=>$input['name'],
								'contact_no'=>$input['contact_no']
								);
					$this->Patient->save($patient);
					$input['patient_id']=$this->Patient->id;
					$input['type']='patient';
					$this->User->save($input);
					$user = $this->User->findById($this->User->id);
					$response['status']='OK';
					$response['data']=array('token'=>$_COOKIE['CAKEPHP']);
					$this->Session->write('user',$user['User']);
					$user['message']='User saved.';
				}
				echo json_encode($response);exit;
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
		if($this->RequestHandler->isAjax()){
			if($this->ajaxInput){
				header('Content-Type: application/json');
				$input =$this->ajaxInput;
				$response = array();
				$_USER = $_SESSION['user'];
				switch($id){
					case 'profile':
						$patient = $input;
						if(!isset($input['id']) || $input['id'] && $_USER['type']!='admin')
							$patient['id']=$_USER['patient_id'];
							
						if($this->Patient->save($patient)){
							$response['status']='OK';
							$response['message']='Profile updated';
						}else{
							$response['status']='ERROR';
							$response['message']='Could not save profile';
						}
					break;
					case 'password':
						$conditions = array(
							'User.id'=>$_USER['id'],
							'User.password'=>md5($input['current']),
						);
						$user  = $this->User->find('first',compact('conditions'));
						if($user){
							$password =  array(
								'id'=>$_USER['id'],
								'password'=>md5($input['change']),
							);
							$this->User->save($password);
							$response['status']='OK';
							$response['message']='Password updated. You will be logged out.';
						}else{
							$response['status']='ERROR';
							$response['message']='Invalid password';
						}
					break;
				}
				echo json_encode($response);
				exit;
			}
		}else{
		
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
					unset($user['Patient']['created']);
					unset($user['Patient']['modified']);
					$user['User']['patient'] = $user['Patient'];
					$response['status']='OK';
					$user['User']['token'] =$_COOKIE['CAKEPHP'];
					$response['data']= $user['User'];
					$response['message']='User logged in';
					$this->Session->write('user',$user['User']);
					
				}else{
					$response['status']='ERROR';
					$response['message']='User / password incorrect';
				}
				echo json_encode($response);exit;
			}
		}
	}
}
