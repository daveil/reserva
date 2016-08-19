<?php
	$views = dirname(dirname(__FILE__));
	$file = "$views/cache/contents.json";
	if(!file_exists($file)){
		if(!file_exists("$views/cache/"))
			mkdir("$views/cache/");
		$contents = array('pages'=>null,'services'=>null);
	}else{
		$contents = json_decode(file_get_contents($file),true);
	}
	$menus = array(
				'home'=>'Home',
				'appointment'=>'Appointment',
	);
	$pages = $contents['pages'];
	if(count($pages))
		foreach($pages as $link=>$title){
			$menus['pages/'.$link]=$title;
		}
	$services = array(
				'services'=>
					array(
						'Services Offered',
						$contents['services']
					)	
				);
	if(count($services))
		$menus = array_merge($menus,$services);
	$admin  = array(
				'calendar'=>'Calendar',
				'patients'=>'Patients',
				'content'=>'Content',
				'settings'=>'Settings'
				);
	$menus = array_merge($menus,$admin);
?>
<ul class="nav nav-pills nav-stacked">
	<?php foreach($menus as $_url=>$title):
				$submenu = null;
				if(is_array($title)){
					$submenu =  $title[1];
					$title =  $title[0];
				}
		?>
		<li class="<?php if($_REQUEST['url']==$_url) echo 'active'; ?>">
			
			<a href="<?php echo WEB_URL.DS.$_url;?>">
				<?php echo $title;?>
			</a>
			<?php if($submenu):?>
				<ul class="nav nav-pills nav-stacked">
					<?php foreach($submenu as $_suburl=>$subtitle):?>
					<li class="<?php if($url==$_url.DS.$_suburl) echo 'active'; ?>">
						<a href="<?php echo WEB_URL.DS.$_url.DS.$_suburl;?>">
							<?php echo $subtitle;?>
						</a>
					</li>
					<?php endforeach;?>
				</ul>
			<?php endif;?>
		</li>
	<?php endforeach;?>
</ul>