<h3>Calendar</h3>
	<div  ng-controller="CalendarController">
		<div>
			<div class="row">
					<div class="col-md-6">
						<div pickadate="" ng-model="SelectedDate" min-date="minDate" id="SelectedDate"></div>
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
								<tr ng-repeat="patient in Patients" ng-if="Patients.length">
								  <td><input type="checkbox" ng-model="patient.checked" ng-checked="CheckAll"/></td>
								  <td><a href="patient_info">{{patient.ref_no}}</a></td>
								  <td>{{patient.name}}</td>
								  <td>{{patient.concern}}</td>
								</tr>
								<tr ng-if="!Patients.length">
									<td colspan="4" class="text-center">No appointments found.</td>
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
								  <div pickadate=""  ng-model="NewSelectedDate" id="NewSelectedDate"></div>
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
  