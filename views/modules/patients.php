<h2 style="margin-top:0;">Patients</h2>
<div ng-controller="PatientsController">
	<div class="row">
	  <div class="col-md-12 col-xs-12">
		  <div class="input-group">
			<input type="text" placeholder="Search patient" class="form-control" ng-model="SearchPatient">
			<div class="input-group-btn">
			  <button class="btn btn-primary" ng-click="search()">
				<span class="glyphicon glyphicon-search"></span>
			  </button>
			</div>
		  </div>
	  </div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<table class="table"> 
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Name</th>
					  <th>Address</th>
					  <th>Summary</th>
					</tr>
				  </thead>
				  <tbody>
					<tr ng-repeat="Record in Records" ng-if="Records.length" >
					  <td>
						  <a href="patient_info/{{Record.Patient.id}}">
							{{Record.Patient.id}}
						  </a>
					  </td>
					  <td>{{Record.Patient.name}}</td>
					  <td>{{Record.Patient.adddress}}</td>
					  <td>{{Record.Appointment[0].concern}}</td>
					</tr>
					<tr ng-if="!Records.length">
						
							<td colspan="4" class="text-center">{{Searching?'Loading...':'No patients found'}}</td>
					
					</tr>
				  </tbody>
			</table>
		</div>
	</div>
</div>
<?php echo Assest::js('patients');?>