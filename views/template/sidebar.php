<?php
	$menus = array(
				'home'=>'Home',
				'appointment'=>'Appointment',
				'calendar'=>'Calendar',
				'patients'=>'Patients',
				'services'=>
					array(
						'Services Offered',
						array(
							'ecg'=>'ECG',
							'cbc'=>'CBC',
							'o2-sat-monitoring'=>'O2 Sat. Monitoring',
							'medical-consultation'=>'Medical Consultation'
						)
				),
				'contact-info'=>'Contact Information',
				'about-us'=>'About Us',
				'content'=>'Content',
				'settings'=>'Settings'
				
	);
?>
<ul class="nav nav-pills nav-stacked">
	<?php foreach($menus as $_url=>$title):
				$submenu = null;
				if(is_array($title)){
					$submenu =  $title[1];
					$title =  $title[0];
				}
		?>
		<li class="<?php if($url==$_url) echo 'active'; ?>">

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