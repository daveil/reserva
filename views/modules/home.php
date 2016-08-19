<?php 
	$url = $_REQUEST['url'];
	$views = dirname(dirname(__FILE__));
	$file = "$views/cache/home.json";
?>

<?php if(!file_exists($file)):?>
	<h2>Welcome to our homepage!</h2>
	<p>No content yet</p>
<?php else:
		$home = json_decode(file_get_contents($file),true);
		foreach($home as $content):
			$h = $content['Content'];
?>
	<div><?php echo $h['content'];?></div>
<?php
		endforeach;
	endif;
?>
	
