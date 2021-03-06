<style type="text/css">
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
</style>
<h2 style="margin-top:0;">History</h2>
<div ng-controller="HistoryController">
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<table class="table"> 
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Date</th>
					  <th>Concern</th>
					  <th>Status</th>
					</tr>
				  </thead>
				  <tbody>
					<tr  ng-class="{success:Record.Appointment.id==ActiveRecord.id}" ng-repeat="Record in Records" ng-if="Records.length" >
					  <td>
						{{Record.Appointment.ref_no}}
					  </td>
					  <td>{{Record.Appointment.schedule}}</td>
					  <td>{{Record.Appointment.concern}}</td>
					  <td>
						<div class="pull-left">{{Record.Appointment.status}}</div>
						<div class="pull-right" ng-show="Record.Appointment.status=='upcoming'">
							<div class="btn-group btn-group-xs" >
								<button class="btn btn-default" ng-click="resched($index)">RESCHED</button>
								<button class="btn btn-danger" ng-click="cancel($index)"  ng-if="Record.Appointment.status!='cancelled'" >CANCEL</button>
							</div>
						</div>
						<div class="clearfix"></div>
					  </td>
					</tr>
					<tr ng-if="!Records.length">
						
							<td colspan="4" class="text-center">{{Searching?'Loading...':'No record(s) found'}}</td>
					
					</tr>
				  </tbody>
			</table>
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
								<div class="row">
									<div class="col-md-6">
										<label for="">Date</label>
										<input type="text" class="form-control" readonly ng-model="NewSelectedDate"/>
									</div>
									<div class="col-md-6">
										<label for="">Time</label>
										<select class="form-control"  ng-model="NewTimeSlot">
											<option >Select time</option>
											<option ng-selected="time.id==NewTimeSlot" ng-repeat="time in clinicHours track by time.id" value="{{time.id}}">
											{{time.name}} 
											</option>
										</select>
									</div>
								</div>
								 <div style="margin:1rem 0;"pickadate=""  ng-model="NewSelectedDate" id="NewSelectedDate"></div>
								  <div class="alert alert-danger" ng-if="ModalMessage">
									{{ModalMessage}}
									<a class="btn btn-danger btn-xs pull-right" ng-click="dismissMessage()">&times;</a>
									<div class="clearfix"></div>
								  </div>
								</div>
								<div ng-if="openModal==='Cancel'">
								  Are you sure you want to cancel?
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default pull-left" data-dismiss="modal" ng-click="openModal=null">Cancel</button>
					  <button type="button" class="btn btn-success pull-right" ng-click="confirmAction()">Confirm</button>
					  <div class="clearfix"></div>
					</div>
				  </div>
				</div>
			</div>
</div>
<?php echo Assest::js('history');?>