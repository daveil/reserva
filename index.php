<?php
	include('config/routes.php');
	include('config/assets.php');
	$__STATUS ='verified';
	$file = "views/cache/settings.json";
	$background = '#ccc';
	$body_class='';
	if(file_exists($file)){
		$settings  =  json_decode(file_get_contents($file),true);
		$company_title = $settings['TITLE'];
		$company_subtitle = $settings['SUBTITLE'];
		if(isset($settings['BACKGROUND'])){
			$bg_url = str_replace(DS,'/',WEB_URL.DS.'img/'.$settings['BACKGROUND']);
			$background ='url(\''.$bg_url.'\')';
		}
	}else{
		$company_title = 'Company';
		$company_subtitle = 'Sample subtitle';
	}
	session_start();
	if(isset($_GET['url'])){
		if($_GET['url']=='login' && isset($_GET['token'])){
			$tmp = ini_get('session.save_path');
			$token = $_GET['token'];
			if(session_decode(file_get_contents($tmp.'/sess_'.$token))){
				header('Location: home');
			}
			$_SESSION['token']=$token;
		}else if($_GET['url']=='logout'){
			session_destroy();
			header('Location: home');
		}else if($_GET['url']=='appointment' || $_GET['url']=='profile'){
			if(isset($_SESSION['token'])){
				$tmp = ini_get('session.save_path');
				$token = $_SESSION['token'];
				session_decode(file_get_contents($tmp.'/sess_'.$token));
				
			}
			
		}
	}
	if(!isset($_GET['url'])){
		$url = 'home';
		
	}else{
		$url =  $_GET['url'];
	}
	if(isset($_SESSION['user'])){
		$__STATUS = $_SESSION['user']['status'];
	}
	if($__STATUS!='verified'){
		$_SESSION['flash_message']='Check your email for the verification link.';
		if($url=='profile'||$url=='appointment'){
			
			header('Location: home');
		}
	}
	if($url){
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