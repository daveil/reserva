<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Reserva -  Online Reservation System</title>
    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- site css -->
    <link rel="stylesheet" href="bower_components/Bootflat/css/site.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="bower_components/Bootflat/js.php5shiv.js"></script>
      <script src="bower_components/Bootflat/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="js/site.min.js"></script>
  </head>
  <body>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-12">
  				<h1>Reserva</h1>
  				<p>Online Reservation System</p>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-4">
  				<ul class="nav nav-pills nav-stacked">
  					<li><a href="index.php">Home</a></li>
  					<li class="active"><a href="appointment.php">Appointment</a></li>
  					<li><a href="calendar.php">Calendar</a></li>
            <li><a href="patients.php">Patients</a></li>
  					<li><a href="services-offered.php">Services Offered</a></li>
  					<li><a href="contact-information.php">Contact Information</a></li>
  					<li><a href="about-us.php">About Us</a></li>
  				</ul>
  			</div>
  			<div class="col-md-8">
  				<h3 style="margin-top:0;">Set an appointment</h3>
				<form action="" class="form-vertical">
					<div class="row">
						<div class="form-group col-md-6 col-md-offset-6">
							<label for="">Date </label>
							<input type="date" class="form-control">
						</div>
						<div class="form-group col-md-12">
							<label for="">Name</label>
							<input class="form-control"  type="text">
						</div>
            <div class="form-group col-md-6">
              <label for="">Contact No. </label>
              <input type="text" class="form-control"/>
            </div>
						<div class="form-group col-md-6">
							<label for="">Age</label>
							<input class="form-control"  type="number">
						</div>
						<div class="form-group col-md-12">
							<label for="">Address</label>
							<input class="form-control" type="text">
						</div>
						<div class="form-group col-md-12">
							<label for="">Concern</label>
							<textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-default pull-left">Cancel</button>
							<button class="btn btn-primary pull-right">Book appointment</button>
						</div>
					</div>
				</form>
  			</div>
  		</div>
  	</div>
  </body>
  </html>