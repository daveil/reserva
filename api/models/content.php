<?php
class Content extends AppModel {
	var $name = 'Content';
	function buildCache(){
		$fields = array('Content.slug','Content.title');
		$conditions = array('Content.status'=>'P','Content.type'=>'page');
		$pages = $this->find('list',compact('conditions','fields'));
		$conditions = array('Content.status'=>'P','Content.type'=>'service');
		$services = $this->find('list',compact('conditions','fields'));
		$data = array(
				'pages'=>$pages,
				'services'=>$services 
				);
		$data = json_encode($data);
		file_put_contents(ROOT.DS.'views'.DS.'cache'.DS.'contents.json',$data);
		
		$conditions = array('Content.status'=>'P','Content.type'=>'page');
		$pages = $this->find('all',compact('conditions'));
		$pages = json_encode($pages);
		file_put_contents(ROOT.DS.'views'.DS.'cache'.DS.'pages.json',$pages);
		
		$conditions = array('Content.status'=>'P','Content.type'=>'service');
		$services = $this->find('all',compact('conditions'));
		$services = json_encode($services);
		file_put_contents(ROOT.DS.'views'.DS.'cache'.DS.'services.json',$services);
		
	}
}
