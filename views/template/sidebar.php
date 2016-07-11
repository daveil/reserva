<?php
	$menus = array(
				'home'=>'Home',
				'appointment'=>'Appointment',
				'calendar'=>'Calendar',
				'patients'=>'Patients',
				'services-offered'=>'Services Offered',
				'contact-info'=>'Contact Information',
				'about-us'=>'About Us',
	);
?>
<ul class="nav nav-pills nav-stacked">
	<?php foreach($menus as $_url=>$title):?>
		<li <?php if($url==$_url) echo 'class=active'; ?>>
			<a href="<?php echo BASE_URL.DS.$_url;?>">
				<?php echo $title;?>
			</a>
		</li>
	<?php endforeach;?>
</ul>