<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Reserva -  Online Reservation System</title>
    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- site css -->
	<?php echo Assest::css('../js/bower_components/Bootflat/css/site.min');?>
	<?php echo Assest::css('style');?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
	<?php echo Assest::js('bower_components/Bootflat/js/php5shiv');?>
	<?php echo Assest::js('bower_components/Bootflat/js/respond.min');?>
    <![endif]-->
	<?php echo Assest::js('bower_components/angular/angular.min');?>
  </head>
  <body  ng-app="APP">
	<?php echo Assest::js('shared/datepicker');?>
	<?php echo Assest::js('shared/main');?>
	<?php echo Assest::js('shared/settings');?>
	<?php echo Assest::js('shared/api');?>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-12">
  				<h1>Fule-Villanueva Medical Clinic</h1>
  				<p>Online Reservation System</p>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-4">
				<?php echo $sidebar; ?>
  			</div>
  			<div class="col-md-8 right-content">
				<?php echo $content; ?>
			</div>
  		</div>
  	</div>
   </body>
</html>