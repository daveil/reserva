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
	if(isset($_SESSION['user'])){
		if($_SESSION['user']['type']=='admin'){
			$admin  = array(
						'calendar'=>'Calendar',
						'patients'=>'Patients',
						'content'=>'Content',
						'settings'=>'Settings'
						);
			$menus = array_merge($menus,$admin);
		}
		$menus['profile']='Profile';
		//$menus['logout']='Logout';
	}else{
		//$menus['login']='Login/Register';
	}
?>
<ul class="nav nav-pills nav-stacked" ng-controller="SidebarController">
	<?php foreach($menus as $_url=>$title):
				$submenu = null;
				if(is_array($title)){
					$submenu =  $title[1];
					$title =  $title[0];
				}
				$in_service =strpos($url,'services')===0;
		?>
		<li class="<?php if($url==$_url) echo 'active'; ?>">
			<?php if($_url=="services"):?>
				<a href="#" ng-click="toggleServices()">
					<?php echo $title;?>
				</a>
			<?php else: ?>
				<a href="<?php echo WEB_URL.DS.$_url;?>">
					<?php echo $title;?>
				</a>
			<?php endif;?>
			<?php if($submenu):?>
				<ul class="nav nav-pills nav-stacked <?php if(!$in_service) echo 'ng-hide';?>" 
				ng-show="ShowServices"
				<?php if($in_service) echo 'ng-init="ShowServices=true"'; ?>
				>
					<?php foreach($submenu as $_suburl=>$subtitle):
						$in_service = $url==$_url.'/'.$_suburl ;
					?>
					<li class="<?php if($in_service) echo 'active'; ?>">
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