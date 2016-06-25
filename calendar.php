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
    <style> 
      .calendar .days .dates .unit{
        color:green;
      }
      .calendar .days .unit.full,.calendar .days .unit.disabled,.calendar .days .unit.holiday{
        color:red;
      }
    </style>
    <script src="bower_components/angular/angular.min.js"></script>
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
  					<li class="active"><a href="calendar.php">Calendar</a></li>
            <li><a href="patients.php">Patients</a></li>
  					<li><a href="services-offered.php">Services Offered</a></li>
  					<li><a href="contact-information.php">Contact Information</a></li>
  					<li><a href="about-us.php">About Us</a></li>
  				</ul>
  			</div>
  			<div class="col-md-8">
          <div class="row">
            <div class="col-md-6">
                  <div class="calendar">
                    <div class="years clearfix">
                      <div class="unit prev"><em></em></div>
                      <div class="monyear">MAY 2014</div>
                      <div class="unit next"><em></em></div>
                    </div>
                    <div class="days">
                      <div class="clearfix">
                        <div class="unit">SU</div>
                        <div class="unit">MO</div>
                        <div class="unit">TU</div>
                        <div class="unit">WE</div>
                        <div class="unit">TH</div>
                        <div class="unit">FR</div>
                        <div class="unit">SA</div>
                      </div>
                      <div class="clearfix dates">
                        <div class="unit older"><b>27</b></div>
                        <div class="unit older"><b>28</b></div>
                        <div class="unit older"><b>29</b></div>
                        <div class="unit older"><b>30</b></div>
                        <div class="unit full"><b>1</b></div>
                        <div class="unit disabled"><b>2</b></div>
                        <div class="unit"><b>3</b></div>
                        <div class="unit"><b>4</b></div>
                        <div class="unit"><b>5</b></div>
                        <div class="unit"><b>6</b></div>
                        <div class="unit"><b>7</b></div>
                        <div class="unit"><b>8</b></div>
                        <div class="unit"><b>9</b></div>
                        <div class="unit"><b>10</b></div>
                        <div class="unit"><b>11</b></div>
                        <div class="unit"><b>12</b></div>
                        <div class="unit"><b>13</b></div>
                        <div class="unit active"><b>14</b></div>
                        <div class="unit"><b>15</b></div>
                        <div class="unit"><b>16</b></div>
                        <div class="unit"><b>17</b></div>
                        <div class="unit"><b>18</b></div>
                        <div class="unit"><b>19</b></div>
                        <div class="unit"><b>20</b></div>
                        <div class="unit"><b>21</b></div>
                        <div class="unit"><b>22</b></div>
                        <div class="unit"><b>23</b></div>
                        <div class="unit"><b>24</b></div>
                        <div class="unit"><b>25</b></div>
                        <div class="unit"><b>26</b></div>
                        <div class="unit"><b>27</b></div>
                        <div class="unit"><b>28</b></div>
                        <div class="unit"><b>29</b></div>
                        <div class="unit"><b>30</b></div>
                        <div class="unit"><b>31</b></div>
                        <div class="unit older"><b>1</b></div>
                        <div class="unit older"><b>2</b></div>
                        <div class="unit older"><b>3</b></div>
                        <div class="unit older"><b>4</b></div>
                        <div class="unit older"><b>5</b></div>
                        <div class="unit older"><b>6</b></div>
                        <div class="unit older"><b>7</b></div>
                      </div>
                    </div>
                  </div> 
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading text-center" style="background: #3bafda;color: white;">
                      <button class="btn btn-default pull-left">OFF</button>
                      <b class="pull-right">JUN 12, 2016</b>  
                      <div class="clearfix"></div>
                  </div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th><input type="checkbox"/></th>
                          <th>#</th>
                          <th>Name</th>
                          <th>Concern</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input type="checkbox"/></td>
                          <td>1</td>
                          <td>Juan</td>
                          <td>Tooth ache</td>
                        </tr>
                        <tr>
                          <td><input type="checkbox"/></td>
                          <td>20</td>
                          <td>Maria</td>
                          <td>Wisdom tooth</td>
                        </tr>
                      </tbody>
                    </table>
                  
                    <div class="row" style="padding:1rem;">
                      <div class="col-md-4">
                          <button class="btn btn-success btn-block">PRINT</button>
                      </div>
                      <div class="col-md-4">
                        <button class="btn btn-warning btn-block">MOVE</button>
                      </div>
                      <div class="col-md-4">
                        <button class="btn btn-danger btn-block">DELETE</button>
                      </div>
                  </div>
                </div>
            </div>
          </div>
  		 </div>
  		</div>
  	</div>
     <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
  </body>
  </html>