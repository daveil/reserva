<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Reserva -  Online Reservation System</title>
    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- site css -->
	<?php echo Assest::css('../js/bower_components/Bootflat/css/site.min');?>
	<?php echo Assest::css('../js/bower_components/summernote/dist/summernote');?>
	<?php echo Assest::css('style');?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
	<?php echo Assest::js('bower_components/Bootflat/js/php5shiv');?>
	<?php echo Assest::js('bower_components/Bootflat/js/respond.min');?>
    <![endif]-->
	<?php echo Assest::js('bower_components/jquery/dist/jquery.min');?>
	<?php echo Assest::js('bower_components/bootstrap/dist/js/bootstrap.min');?>
	<?php echo Assest::js('bower_components/summernote/dist/summernote.min');?>
	<?php echo Assest::js('bower_components/angular/angular.min');?>
	<?php echo Assest::js('bower_components/angular-summernote/dist/angular-summernote');?>
	<style type="text/css">
	body{
		background:#ccc;
		
	}
	.container{
		background:white;
		min-height:100vh;
		height:100vh;
	}
	</style>
	</head>
  
  <body  ng-app="APP">
	<?php echo Assest::js('shared/datepicker');?>
	<?php echo Assest::js('shared/main');?>
	<?php echo Assest::js('shared/settings');?>
	<?php echo Assest::js('shared/api');?>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-12">
  				<h1 class="visible-md-block visible-lg-block"><?php echo $company_title;?></h1>
 				<h3 class="text-center visible-sm-block visible-xs-block"><?php echo $company_title;?></h3>
  				<p><?php echo $company_subtitle;?>
					<?php if(isset($_SESSION['user'])) echo '/ <b>'.$_SESSION['user']['username'].'</b>';?>
				</p>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-3 col-xs-6">
				<?php echo $sidebar; ?>
  			</div>
  			<div class="col-md-9 col-xs-6 right-content">
				<?php echo $content; ?>
			</div>
  		</div>
  	</div>
   </body>
</html>