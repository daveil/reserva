<?php
	if(!isset($_GET['url'])){
		$url = 'home';
	}else{
		$url =  $_GET['url'];
	}
	if($url){
		ob_start();
		include('views/modules/'.$url.'.php');
		$content = ob_get_clean(); 
	}
	include('views/template/default.php');
?>