<style type="text/css"> 
.form-vertical .ng-invalid.ng-touched {
    background-color: #FA787E;
  }
 
  .calendar .days .unit.pickadate-unavailable b{
	  color:#f60f08 !important;
	  font-size:1.1rem;
	  font-weight:bold;
  }
  .calendar .days .unit.older b{
	  color:#AAB2BD !important;
  }
  .unit.pickadate-enabled b:hover{
	  color:#40a006 !important;
  }
  .unit.pickadate-enabled.active b{
	  color:#fff !important; background-color:#40a006 !important;
  }
  #note{
	  font-size:12px;
	  margin-top:1rem;
	  font-style:italic;
  }
</style>
<h3 style="margin-top:0;">Set an appointment</h3>
<?php
	$user = null;
	if(isset($_SESSION['user']))
		$user = json_encode($_SESSION['user']);
?>
<div ng-controller='AppointmentController' ng-init='init(<?php echo $user;?>)'>
	<form class="form-vertical" name="AppointmentForm">
		<div class="row">
			<div class="col-md-6 col-xs-9">
			 <div pickadate="" ng-model="SelectedDate" min-date="minDate" disabled-dates="disabledDates" allowed-days="clinicDays" on-change-month="onChangeMonth" id="SelectedDate"></div>
			 <span id="note">*The dates in red the doctor is unavailable or there are no more slots.</span>
			</div>
			<div class="col-md-6 col-xs-3">
				<div class="form-group col-md-6">
					<label for="">Date</label>
					<input class="form-control" ng-model="Appointment.schedule"  type="text" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="">Time</label>
					<select class="form-control" ng-model="Appointment.timeslot">
						<option value="" ng-repeat="time in clinicHours track by time.id" ng-value="time.id">
						{{time.name}}
						</option>
					</select>
				</div>
				<div class="form-group col-md-12 col-xs-12">
					<label for="">Name</label>			
					<input class="form-control"  type="text" name="name" ng-model="Patient.name" required />
				</div>
				<div class="form-group col-md-6 col-xs-10">
				  <label for="">Contact No. </label>
				  <input type="number" class="form-control" name="contact_no" ng-model="Patient.contact_no"  ng-minlength="11" maxlength="11" ng-maxlength="11"  ng-keypress="validateLength($event)" required/>
				</div>
				<div class="form-group col-md-6 col-xs-2">
					<label for="">Age</label>
					<input class="form-control"  name="age" type="number" ng-model="Patient.age" required/>
				</div>
				<div class="form-group col-md-12 col-xs-12">
					<label for="">Address</label>
					<input class="form-control" name="address" type="text"  ng-model="Patient.adddress" required/>
				</div>
				<div class="form-group col-md-12 col-xs-12">
					<label for="">Concern</label>
					<textarea class="form-control" name="concern" id="" cols="30" rows="3" ng-model="Appointment.concern" required></textarea>
				</div>
			</div>
		</div>
		<div class="row" style="padding-top:10px">
			<div class="col-md-6 col-xs-6">
				<button class="btn btn-default" ng-click="cancelAppointment()" ng-disabled="SavingAppointment">Cancel</button>
			</div>
			<div class="col-md-6 col-xs-6">
				<button class="btn btn-primary pull-right"  ng-click="bookAppointment()" ng-disabled="SavingAppointment">Book appointment</button>
			</div>
		</div>
	</form>

	<div class="modal-blind" ng-class="{show:ShowModal||ShowLogin}"></div>
	<div class="modal" ng-class="{show:ShowModal}">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">
				{{AppointmentStatus==='OK'?'Success':'Warning'}}
			  </h4>
			</div>
			<div class="modal-body">
				<div class="row" >
					<div class="col-md-12">
					{{ModalMessage}}
					</div>
					<div class="text-center" ng-if="RefNo">
						<span>REF NO:</span>
						<h3>{{RefNo}}</h3>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			 <button type="button" class="btn  btn-default pull-left"  ng-if="RefNo" ng-click="printRefNo()">Print</button>
			 <button type="button" class="btn  pull-right" ng-class="{'btn-success':AppointmentStatus==='OK','btn-danger':AppointmentStatus!=='OK'}" ng-click="closeModal()">Close</button>
			  <div class="clearfix"></div>
			</div>
		  </div>
		</div>
	</div>
	<div class="modal" ng-class="{show:openLoginModal}">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">
				Login/Register
			  </h4>
			  <button class="close" ng-click="dismissLogin()">×</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form name="Login" class="form-vertical col-md-12 col-xs-12">
							  <div class="form-group">
								<label for="">Username</label>
								<input type="text" name="username" ng-model="Username" class="form-control">
							  </div>
							  <div class="form-group">
								<label for="">Password</label>
								<input type="password" name="password" ng-model="Password" class="form-control">
							  </div>
							<div class="alert alert-danger"  ng-if="ErrorMessage">{{ErrorMessage}}</div>		  
							<div class="pull-right">
							<button class="btn btn-primary" ng-click="login()">LOGIN</button>
							<button class="btn btn-default" ng-click="register()">REGISTER</button>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
			</div>
		 </div>
		</div>
	</div>
</div>
<?php echo Assest::js('appointment');?>
