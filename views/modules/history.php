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
					<tr ng-repeat="Record in Records" ng-if="Records.length" >
					  <td>
						{{Record.Appointment.ref_no}}
					  </td>
					  <td>{{Record.Appointment.schedule}}</td>
					  <td>{{Record.Appointment.concern}}</td>
					  <td>
						{{Record.Appointment.status}}
						<div class="btn-group btn-group-sm" ng-if="Record.Appointment.status=='upcoming'">
							<button class="btn btn-default" ng-click="cancelAppointment(Record.Appointment.id)">CANCEL</button>
							<button class="btn btn-default" ng-click="reschedAppointment(Record.Appointment.id)">RESCHED</button>
						</div>
					  </td>
					</tr>
					<tr ng-if="!Records.length">
						
							<td colspan="4" class="text-center">{{Searching?'Loading...':'No record(s) found'}}</td>
					
					</tr>
				  </tbody>
			</table>
		</div>
	</div>
</div>
<?php echo Assest::js('history');?>