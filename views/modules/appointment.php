<h3 style="margin-top:0;">Set an appointment</h3>
<div ng-controller="AppointmentController">
	{{ShowModal}}
	<form class="form-vertical">
		<div class="row">
			<div class="col-md-6">
			 <div pickadate="" ng-model="SelectedDate" min-date="minDate" disabled-dates="disabledDates" allowed-days="clinicDays" on-change-month="onChangeMonth" id="SelectedDate"></div>
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
	</form>

	<div class="modal-blind" ng-class="{show:ShowModal}"></div>
	<div class="modal" ng-class="{show:ShowModal}">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Appointment Message</h4>
			</div>
			<div class="modal-body">
				<div class="row" >
					<div class="col-md-12">
					{{ModalMessage}}
					</div>
				</div>
			</div>
			<div class="modal-footer">
		
			  <button type="button" class="btn btn-success pull-right" ng-click="closeModal()">Close</button>
			  <div class="clearfix"></div>
			</div>
		  </div>
		</div>
	</div>
</div>
<?php echo Assest::js('appointment');?>
