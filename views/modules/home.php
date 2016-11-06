<?php 
	//$url = $_REQUEST['url'];
	$views = dirname(dirname(__FILE__));
	$file = "$views/cache/home.json";
?>
<?php if(!file_exists($file)):?>
	<h2>Welcome to our homepage!</h2>
	<p>No content yet</p>
<?php else:
		$home = json_decode(file_get_contents($file),true);
		if(count($home)):
			foreach($home as $content):
			$h = $content['Content'];
?>
			<div><?php echo $h['content'];?></div>
<?php
			endforeach;
		else:
?>
		<h2>Welcome to our homepage!</h2>
		<p>No content yet</p>
<?php
		endif;
	endif;
?>
<?php if(isset($_SESSION['flash_message']))
	echo '<div class="alert alert-warning"><span class="glyphicon glyphicon-envelope"></span> &nbsp;'.$_SESSION['flash_message'].'</div>';
	?>
	
	<?php if(isset($_GET['verified']))
	echo '<div class="alert alert-success"><span class="glyphicon glyphicon-check"></span> &nbsp;Account verified! Please login.</div>';
	?>
