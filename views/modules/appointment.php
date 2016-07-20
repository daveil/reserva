<h3 style="margin-top:0;">Set an appointment</h3>
<div ng-controller="AppointmentController">
	<form class="form-vertical">
		<div class="row">
			<div class="col-md-6">
			 <div pickadate="" ng-model="SelectedDate" min-date="minDate" disabled-dates="disabledDates" id="SelectedDate"></div>
			</div>
			<div class="col-md-6">
				<div class="form-group col-md-12">
					<label for="">Date</label>
					<input class="form-control" ng-model="Appointment.schedule"  type="text" disabled>
				</div>
				<div class="form-group col-md-12">
					<label for="">Name</label>
					<input class="form-control"  type="text" ng-model="Patient.name">
				</div>
				<div class="form-group col-md-6">
				  <label for="">Contact No. </label>
				  <input type="text" class="form-control"  ng-model="Patient.contact_no"/>
				</div>
				<div class="form-group col-md-6">
					<label for="">Age</label>
					<input class="form-control"  type="number" ng-model="Patient.age">
				</div>
				<div class="form-group col-md-12">
					<label for="">Address</label>
					<input class="form-control" type="text" ng-model="Patient.adddress">
				</div>
				<div class="form-group col-md-12">
					<label for="">Concern</label>
					<textarea class="form-control" name="" id="" cols="30" rows="3" ng-model="Appointment.concern"></textarea>
				</div>
			</div>
		</div>
		<div class="row" style="padding-top:10px">
			<div class="col-md-6">
				<button class="btn btn-default" ng-click="cancelAppointment()" ng-disabled="SavingAppointment">Cancel</button>
			</div>
			<div class="col-md-6">
				<button class="btn btn-primary pull-right"  ng-click="bookAppointment()" ng-disabled="SavingAppointment">Book appointment</button>
			</div>
		</div>
	</div>
	</form>
</div>
<?php echo Assest::js('appointment');?>
