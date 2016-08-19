<?php
class ContentsController extends AppController {

	var $name = 'Contents';

	function index() {
		$this->Content->recursive = 0;
		if($this->RequestHandler->isAjax()){
			$data = array() ;
			foreach($this->Content->find('all') as $content){
				array_push($data,$content['Content']);
			}
			echo json_encode($data);exit;
		}else{
			$this->set('contents', $this->paginate());	
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid content', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('content', $this->Content->read(null, $id));
	}

	function add() {
		if($this->RequestHandler->isAjax()){
			$input = file_get_contents('php://input');
			header('Content-Type: application/json');
			$this->data = json_decode($input,true);
		}
		if (!empty($this->data)) {
			$this->Content->create();
			if ($this->Content->save($this->data)) {
				$content =  array();
				if($this->RequestHandler->isAjax()){
					$content['status']='OK';
					$content['data']=$this->Content->findById($this->Content->id);
					$content['message']='Content saved.';
					echo json_encode($content);exit;
				}else{
					$this->Session->setFlash(__('The content has been saved', true));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($input){
					$content['status']='ERROR';
					$content['message']='Could not save content';
					echo json_encode($content);exit;
				}else{
					$this->Session->setFlash(__('The content could not be saved. Please, try again.', true));
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid content', true));
			$this->redirect(array('action' => 'index'));
		}
		if($this->RequestHandler->isAjax()){
			if($this->ajaxInput){
				header('Content-Type: application/json');
				$input =$this->ajaxInput;
				
				$contents = $input['contents'];
				$status = $input['status'];
				$this->Content->updateAll(
						array('Content.status'=>'"'.$status.'"'),
						array('Content.id'=>$contents)
						);
				$response = array();
				$response['status'] = 'OK';
				$response['data'] = null;
				echo json_encode($response);exit;
			}
		}else{
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('The content has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The content could not be saved. Please, try again.', true));
			}
		}
		if (!empty($this->data)) {
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('The content has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The content could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Content->read(null, $id);
		}
	}

	function delete($id = null) {
		if($this->RequestHandler->isAjax()){
			if($this->ajaxInput){
				header('Content-Type: application/json');
				$input =$this->ajaxInput;
				$contents = $input['contents'];
				$this->Content->deleteAll(
						array('Content.id'=>$contents)
						);
				$response = array();
				$response['status'] = 'OK';
				$response['data'] = null;
				echo json_encode($response);exit;
			}
		}else{
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for content', true));
				$this->redirect(array('action'=>'index'));
			}
			
			if ($this->Content->delete($id)) {
				$this->Session->setFlash(__('Content deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Content was not deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		
		
		
	}
}
