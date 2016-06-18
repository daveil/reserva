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
  			 <h2 style="margin-top:0;">Patients</h2>
          <div class="row">
              <div class="col-md-12">
                  <div class="input-group">
                    <input type="text" placeholder="Search patient" class="form-control">
                    <div class="input-group-btn">
                      <button class="btn btn-primary">
                        <span class="glyphicon glyphicon-search"></span>
                      </button>
                    </div>
                  </div>
              </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
                <table class="table"> 
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Summary</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Patient A</td>
                          <td>Santo Tomas, Batangas</td>
                          <td>Last checkup</td>
                        </tr>
                        <tr>
                          <td>Patient B</td>
                          <td>Santo Tomas, Batangas</td>
                          <td>Last checkup</td>
                        </tr>
                        <tr>
                          <td>Patient C</td>
                          <td>Santo Tomas, Batangas</td>
                          <td>Last checkup</td>
                        </tr>
                        <tr>
                          <td>Patient D</td>
                          <td>Santo Tomas, Batangas</td>
                          <td>Last checkup</td>
                        </tr>
                      </tbody>
                </table>
            </div>
          </div>
        </div>
  		</div>
  	</div>
     <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
  </body>
  </html>