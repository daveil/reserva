<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Reserva -  Online Reservation System</title>
    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- site css -->
    <link rel="stylesheet" href="bower_components/Bootflat/css/site.min.css">
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
  					<li><a href="appointment.php">Appointment</a></li>
  					<li><a href="calendar.php">Calendar</a></li>
            <li class="active"><a href="patients.php">Patients</a></li>
  					<li><a href="services-offered.php">Services Offered</a></li>
  					<li><a href="contact-information.php">Contact Information</a></li>
  					<li><a href="about-us.php">About Us</a></li>
  				</ul>
  			</div>
  			<div class="col-md-8">
  			 <h2 style="margin-top:0;">Patient Information</h2>
         <div class="row">
           <div class="col-md-4">
             <dl>
               <dt>Name</dt>
               <dd>Juan Dela Cruz</dd>
               <dt>Age</dt>
               <dd>12</dd>
               <dt>Address</dt>
               <dd>Santo Tomas, Batangas</dd>
             </dl>
           </div>
           <div class="col-md-8">
              <dl>
               <dt>Contact No</dt>
               <dd>(043) 211 1111</dd>
             </dl>
           </div>
         </div>
         <h3>History</h3>
         <table class="table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Concern</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Jun 12,2016</td>
                <td>Tooth Ache</td>
              </tr>
              <tr class="active">
                <td>Jun 13,2016</td>
                <td>Tooth Ache</td>
              </tr>
            </tbody>
         </table>
        </div>
  		</div>
  	</div>
     <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
  </body>
  </html>