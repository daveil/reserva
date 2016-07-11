<?php
	if(!isset($_GET['url'])){
		$url = 'home';
	}else{
		$url =  $_GET['url'];
	}
	if($url){
		include('config/routes.php');
		include('config/assets.php');
		ob_start();
		if(isset($routes[$url])){
			$url = $routes[$url];
		}
		
		if(file_exists('views/modules/'.$url.'.php')){
			include('views/modules/'.$url.'.php');
		}else{
			include('views/template/file_not_found.php');
			
		}
		$content = ob_get_clean(); 
	}
	include('views/template/sidebar.php');
	$sidebar = ob_get_clean(); 
	include('views/template/default.php');
?>