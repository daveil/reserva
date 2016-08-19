<?php 
	$url = $_REQUEST['url'];
	$slug =  str_replace('services/','',$url);
	$views = dirname(dirname(__FILE__));
	$file = "$views/cache/services.json";
	if(!file_exists($file)){
		$title = "Oops!";
		$content ="URL requested <b><i>$url</i></b> not found.";
		
	}
	
	$title ="Services Offered";
	$contents = "$views/cache/contents.json";
	if(!file_exists($contents)){
		$title = "Oops!";
		$text ="URL requested <b><i>$url</i></b> not found.";
	}else{
		$contents = json_decode(file_get_contents($contents),true);
		$text = "<ul>";
		foreach($contents['services'] as $link=>$item){
			$text .="<li><a href=\"services/$link\">$item</a></li>";
		}
		$text .= "</ul>";
	}
	$services = json_decode(file_get_contents($file),true);
	foreach($services as $service){
		$content = $service['Content'];
		if($content['slug'] == $slug){
			$title = $content['title'];
			$text =$content['content'];
		}
	}
	
?>
<h2><?php echo $title;?></h2>
<p><?php echo $text;?></p>
