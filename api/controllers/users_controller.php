<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $uses = array('User','Patient');
	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		if($this->RequestHandler->isAjax()){
			if(isset($_GET['search'])){
				$name ='%'.$_GET['search'].'%';
				$conditions = array('User.username LIKE'=>$name);
				$paginate['conditions']=$conditions;
				$this->paginate = $paginate;
			}
			
			$data = $this->paginate();
			echo json_encode($data);exit;
		}
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
				}elseif($this->User->findByEmail($input['email'])){
					$response['status']='ERROR';
					$response['message']='Email already taken.';
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
					$username = $user['User']['username'];
					$token  = md5(json_encode($username));
					$token .= '-'.md5(json_encode($user['User']));
					$user['User']['patient']=$user['Patient'];
					$response['data']=array(
											'id'=>$this->User->id,
											'patient_id'=>$this->Patient->id,
											'status'=>'pending',
											'token'=>$_COOKIE['CAKEPHP']
										);
					$this->Session->write('user',$user['User']);
					$user['message']='User saved.';
					$email =  $input['email'];
					$subject ='Thank you!';
					$message= 'Thank you for registering to Fule-Villanueva Online Reservation. Click the link below to verify. <br/>';
					$host = $_SERVER['HTTP_HOST'];
					if($host=='localhost'){$host.="/reserva"; }
					
					$link = 'http://'.$host.'/api/users/verify/'.$username.'/'.$token;
					$message.= '<a href="'.$link.'">'.$link.'</a>';
					
					$send = $this->User->sendEmail($email,$subject,$message);
					$response['status'] = $send['status'];
					$response['message'] = $message;
					if($response['status'] =='ERROR')
						$response['message'] = $send['message'];
						
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
							$_SESSION['user']['patient']=$patient;
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
					case 'resetpass':
						$isAdmin = $_USER['type']=='admin';
						if($isAdmin){
							$this->User->updateAll(
								array('User.password'=>"'".md5('password')."'"),
								array('User.id'=>$input['users'])
							);
							$response['status']='OK';
							$response['message']='Password has been reset.';
						}else{
							$response['status']='ERROR';
							$response['message']='Access denied';
						}
					break;
					case 'mkusr':
						$isAdmin = $_USER['type']=='admin';
						if($isAdmin){
							$this->User->updateAll(
								array('User.type'=>"'".$input['type']."'"),
								array('User.id'=>$input['users'])
							);
							$response['status']='OK';
							$response['message']='User type has been updated to '.$input['type'];
						}else{
							$response['status']='ERROR';
							$response['message']='Access denied';
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
	public function test(){
		$this->User->sendEmail('arroyo.daveil@gmail.com','Hello','Testing');
		exit;
	}
	function verify($username=null,$token=null){
		$user = $this->User->findByUsername($username);
		$hash =  md5(json_encode($username)).'-'.md5(json_encode($user['User']));
		if($user['User']['username']==$username&&$hash==$token){
			$user['User']['status']='verified';
			unset($user['User']['created']);
			unset($user['User']['modified']);
			$this->User->save($user);
			$host = $_SERVER['HTTP_HOST'];
			if($host=='localhost'){$host.="/reserva"; }
			$this->redirect('http://'.$host.'/home?verified');
		}
		
	}
}
