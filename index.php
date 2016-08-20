<?php
	session_start();
	if(isset($_GET['url'])){
		if($_GET['url']=='login' && isset($_GET['token'])){
			$tmp = ini_get('session.save_path');
			$token = $_GET['token'];
			if(session_decode(file_get_contents($tmp.'/sess_'.$token))){
				header('Location: home');
			}
		}else if($_GET['url']=='logout'){
			session_destroy();
			header('Location: home');
		}
	}
	if(!isset($_GET['url'])){
		$url = 'home';
	}else{
		$url =  $_GET['url'];
	}
	if($url){
		include('config/routes.php');
		include('config/assets.php');
		ob_start();
		if(!isset($routes[$url])){
			foreach ($routes as $pattern=>$route) {
				$pattern = '/' . str_replace('/', '\/', $pattern) . '/';
				preg_match($pattern, $url,$params);
				if($params){
					$url =  $route;
					array_shift($params);
				}
			}
		}else{
			$url =  $routes[$url];
		}
		if(file_exists('views/modules/'.$url.'.php')){
			include('views/modules/'.$url.'.php');
		}else{
			include('views/template/file_not_found.php');
			
		}
		// add comm
		$content = ob_get_clean(); 
	}
	include('views/template/sidebar.php');
	// add comm
	$sidebar = ob_get_clean(); 
	include('views/template/default.php');
?>