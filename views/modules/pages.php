<?php 
	$url = $_REQUEST['url'];
	$slug =  str_replace('pages/','',$url);
	$views = dirname(dirname(__FILE__));
	$file = "$views/cache/pages.json";
	if(!file_exists($file)){
		$title = "Oops!";
		$text ="URL requested <b><i>$url</i></b> not found.";
		
	}
	$pages = json_decode(file_get_contents($file),true);
	foreach($pages as $page){
		$content = $page['Content'];
		if($content['slug'] == $slug){
			$title = $content['title'];
			$text =$content['content'];
		}
	}
?>
<h2><?php echo $title;?></h2>
<p><?php echo $text;?></p>
