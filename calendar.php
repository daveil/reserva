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
    <style> 
      .calendar .days .dates .unit{
        color:green;
      }
      .calendar .days .unit.full,.calendar .days .unit.disabled,.calendar .days .unit.holiday{
        color:red;
      }
      .modal-blind{
        position: fixed;
        width:100%;
        height:100%;
        background: white;
        opacity: 0.5;
        top:0;
        left: 0;
        display: none;
      }
    </style>
    <script src="bower_components/angular/angular.min.js"></script>
  </head>
  <body>
    <script src="js/shared/main.js"></script>
    <script src="js/shared/settings.js"></script>
    <script src="js/shared/api.js"></script>
  	<div class="container" ng-app="APP">
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
  			<div class="col-md-8" ng-controller="CalendarController">
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
                      <b class="pull-right">{{SelectedDate | date:short}}</b>  
                      <div class="clearfix"></div>
                  </div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th><input type="checkbox" ng-click="toggleCheckbox()"/></th>
                          <th>#</th>
                          <th>Name</th>
                          <th>Concern</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="patient in Patients">
                          <td><input type="checkbox" ng-model="patient.checked" ng-checked="CheckAll"/></td>
                          <td><a href="patient_info.php">{{patient.ref_no}}</a></td>
                          <td>{{patient.name}}</td>
                          <td>{{patient.concern}}</td>
                        </tr>
                      </tbody>
                    </table>
                  
                    <div class="row" style="padding:1rem;">
                      <div class="col-md-4">
                          <button class="btn btn-success btn-block" ng-click="print()">PRINT</button>
                      </div>
                      <div class="col-md-4">
                        <button class="btn btn-warning btn-block" ng-click="move()">MOVE</button>
                      </div>
                      <div class="col-md-4">
                        <button class="btn btn-danger btn-block" ng-click="delete()">DELETE</button>
                      </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="modal-blind" ng-class="{show:openModal}"></div>
          <div class="modal" ng-class="{show:openModal}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">{{openModal}} Schedule</h4>
                </div>
                <div class="modal-body">
                    <div class="row" >
                        <div class="col-md-12">
                            <div ng-if="openModal==='Move'" class="form-group">
                              <label for="">Date</label>
                              <input type="date" class="form-control">
                            </div>
                            <div ng-if="openModal==='Delete'">
                              Are you sure you want to delete?
                            </div>
                             <div ng-if="openModal==='Print'">
                              Are you sure you want to print?
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal" ng-click="openModal=null">Cancel</button>
                  <button type="button" class="btn btn-success pull-right" ng-click="openModal=null">Confirm</button>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
  		 </div>
  		</div>
  	</div>
     <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">-->
     <script src="js/calendar.js"></script>
  </body>
  </html>