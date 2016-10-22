<style type="text/css"> 
 .calendar .days .unit.older b{
	  color:#AAB2BD !important;
  }
	.full>b,.full.book>b{color:#ca1510;font-weight: bold !important;}
	.full.active>b,.full:hover>b,.full.book.active>b,.full.book:hover>b{color:#fff !important; background-color:#ca1510 !important;}
	.book>b{color:#40a006;font-weight: bold !important;}
	.book.active>b,.book:hover>b{color:#fff !important; background-color:#40a006 !important;}
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
<h3>Calendar</h3>
	<div  ng-controller="CalendarController">
		<div>
			<div class="row">
					<div class="col-md-6 col-xs-7">
						<div pickadate="" ng-model="SelectedDate" min-date="minDate" on-change-month="onChangeMonth" status-dates="statusDates" id="SelectedDate"></div>
					</div>
					<div class="col-md-6 col-xs-5">
						<div class="panel panel-default">
						  <div class="panel-heading text-center" style="background: #3bafda;color: white;">
							  <button class="btn {{IsEnabled?'btn-success':'btn-danger'}} pull-left" ng-disabled="Loading" ng-click="toggleStatus(SelectedDate)">
									{{IsEnabled?'ON':'OFF'}}
							  </button>
							  <b class="pull-right">{{SelectedDate | date:short}}</b>  
							  <div class="clearfix"></div>
						  </div>
							<table class="table">
							  <thead>
								<tr>
								  <th><input type="checkbox" ng-model="ToggleCheckbox" ng-click="toggleCheckbox()"/></th>
								  <th>#</th>
								  <th>Name</th>
								  <th>Concern</th>
								  <th>Status</th>
								</tr>
							  </thead>
							  <tbody>
								<tr ng-repeat="patient in Patients" ng-if="Patients.length">
								  <td><input type="checkbox" ng-model="patient.checked" ng-checked="CheckAll&&patient.status!='cancelled'"/></td>
								  <td><a href="patient_info/{{patient.id}}">{{patient.ref_no}}</a></td>
								  <td>{{patient.name}}</td>
								  <td ng-if="patient.status!='cancelled'">{{patient.concern}}</td>
								  <td class="text-right" colspan="{{patient.status!='cancelled'?1:2}}">
									<div ng-show="AllowUpdateStatus">
										<div ng-show="patient.status!='cancelled'">
										<button class="btn btn-xs"  ng-class="{'btn-default':patient.status=='upcoming','btn-success':patient.status=='show','btn-danger':patient.status=='not show'}" 
											ng-disabled="patient.updating"
											ng-click="updateAppointmentStatus(patient.aid,patient.status,$index)"
											>
											{{patient.status!='not show'?'SHOW':'M&nbsp;I&nbsp;S&nbsp;S'}}
										</button>
										</div>
									</div>
									<div ng-show="patient.status=='cancelled'">
										<button class="btn btn-default btn-xs" disabled>CANCELLED</button>
									</div>
									<div ng-show="!AllowUpdateStatus && patient.status!='cancelled'">
										<button class="btn btn-default btn-xs">UPCOMING</button>
									</div>
								  </td>
								</tr>
								<tr ng-if="!Patients.length">
									<td colspan="5" class="text-center">
										{{Loading? 'Loading...':'No appointments found.'}}	
									</td>
								</tr>
							  </tbody>
							</table>
						  
							<div class="row" style="padding:1rem;">
							  <div class="col-md-4">
								  <button class="btn btn-success btn-block" ng-disabled="!Patients.length" ng-click="print()">PRINT</button>
							  </div>
							  <div class="col-md-4">
								<button class="btn btn-warning btn-block" ng-disabled="!Patients.length" ng-click="move()">MOVE</button>
							  </div>
							  <div class="col-md-4">
								<button class="btn btn-danger btn-block"  ng-disabled="!Patients.length" ng-click="delete()">DELETE</button>
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
								  <input type="text" class="form-control" readonly ng-model="NewSelectedDate"/>
								  <div style="margin:1rem 0;"pickadate=""  ng-model="NewSelectedDate" id="NewSelectedDate"></div>
								  <div class="alert alert-danger" ng-if="ModalMessage">{{ModalMessage}}</div>
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
					  <button type="button" class="btn btn-success pull-right" ng-click="confirmAction()">Confirm</button>
					  <div class="clearfix"></div>
					</div>
				  </div>
				</div>
			</div>
		</div>
    </div>
	<?php echo Assest::js('calendar');?>

  