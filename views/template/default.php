<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $company_title;?> -  <?php echo $company_subtitle;?></title>
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
		background:<?php echo $background;?>;
		
	}
	.container{
		background:white;
		min-height:100vh;
		height:auto;
	}
	@media (max-width:768px){
		  .container {
			margin: 20px 10px 0px 10px;
		  }
		}
	@media (min-width: 992px) {
		  .container {
			width: 970px;
		  }
		}
	.calendar{
		background:#fff;
		color:#434a54;
	}
	.calendar .days{
		border-top: 1px solid #434a54;
	}
	.calendar .years .next em, .calendar .years .prev em{
		border-color:#434a54;
		
	}
	.calendar .years .prev em:before{
		border-color:transparent #434a54 transparent transparent ; 
	}
	.calendar .years .next em:before{
		border-color:transparent transparent transparent #434a54; 
	}
	</style>
	</head>
  
  <body  ng-app="APP" class="<?php echo $body_class;?>">
	<?php echo Assest::js('shared/datepicker');?>
	<?php echo Assest::js('shared/main');?>
	<?php echo Assest::js('shared/settings');?>
	<?php echo Assest::js('shared/api');?>
  	<div class="container" ng-controller="MainController">
		<?php if($url!='uploader'):?>
  		<div class="row" id="header">
  			<div class="col-md-12">
  				<h1 class="visible-md-block visible-lg-block"><?php echo $company_title;?></h1>
 				<h3 class="text-center visible-sm-block visible-xs-block"><?php echo $company_title;?></h3>
  				<p><?php echo $company_subtitle;?>
					<?php if(isset($_SESSION['user'])) echo '/ <b>'.$_SESSION['user']['username'].'</b>';?>
				</p>
  			</div>
  		</div>
		<?php endif; ?>
  		<div class="row">
			<?php if($url!='uploader'):?>
  			<div class="col-md-3">
				<?php echo $sidebar; ?>
  			</div>
			<?php endif; ?>
			<div class="text-center" ng-if="PreLoading">Loading...</div>
			<div class="col-md-9 right-content hide" ng-class="{hide:PreLoading,show:!PreLoading}">
			<?php if(!isset($_SESSION['user'])):?>
            <a class="btn btn-primary pull-right" href="<?php echo WEB_URL.DS.'login';?>">Login/Register</a>
			<?php else:?>
            <a class="btn btn-danger pull-right" href="<?php echo WEB_URL.DS.'logout';?>">Logout</a>
			<?php endif;?>
			<div class="clearfix"></div>			
			<?php echo $content; ?>
			</div>
  		</div>
  	</div>
   </body>
</html>