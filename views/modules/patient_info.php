<?php
	$url = $_REQUEST['url'];
	$id =  str_replace('patient_info/','',$url); 
?>
	<h2 style="margin-top:0;">Patient Information</h2>
	<div ng-controller="PatientInfoController" ng-init="PatientId=<?php echo $id;?>">
		<div class="row">
			<div class="col-md-12" ng-show="Mode=='VIEW'">
				<a class="btn btn-default" href="<?php echo WEB_URL.DS.'patients';?>">
					&larr; Back to Patients
				</a>
				<button class="btn btn-primary pull-right" ng-click="edit()">EDIT</button>
			</div>
			<div class="col-md-12" ng-show="Mode=='EDIT'">
				<div class="pull-right">
					<button class="btn btn-default" ng-disabled="Saving" ng-click="cancel()">CLOSE</button>
					<button class="btn btn-primary" ng-disabled="Saving"  ng-click="updateInfo()">CONFRIM</button>
				</div>
			</div>
		</div>
		<hr />
		<div class="row"  ng-show="Mode=='VIEW'">
			<div class="col-md-6">
			 <dl>
			   <dt>Name</dt>
			   <dd>{{Patient.name}}</dd>
			   <dt>Age</dt>
			   <dd>{{Patient.age}}</dd>
			  
			 </dl>
			</div>
			<div class="col-md-6">
			  <dl>
			   <dt>Contact No</dt>
			   <dd>{{Patient.contact_no}}</dd>
			    <dt>Address</dt>
			   <dd>{{Patient.adddress}}</dd>
			 </dl>
				
			</div>
		</div>
		<div class="row"  ng-show="Mode=='EDIT'">
			<div class="col-md-6">
			 <dl>
			   <dt>Name</dt>
			   <dd><input type="text" class="form-control" ng-model="Patient.name"/></dd>
			   <dt>Age</dt>
			   <dd><input type="text" class="form-control" ng-model="Patient.age"/></dd>
			  
			 </dl>
			</div>
			<div class="col-md-6">
			  <dl>
			   <dt>Contact No</dt>
			   <dd><input type="text" class="form-control" ng-model="Patient.contact_no"/></dd>
			    <dt>Address</dt>
			   <dd><input type="text" class="form-control" ng-model="Patient.adddress"/></dd>
			 </dl>
				
			</div>
		</div>
		
		<h3>History</h3>
		<table class="table">
		<thead>
		  <tr>
			<th>Date</th>
			<th>Concern</th>
		  </tr>
		</thead>
		<tbody>
		  <tr ng-repeat="Appointment in Appointments">
			<td>{{Appointment.schedule}}</td>
			<td>{{Appointment.concern}}</td>
		  </tr>
		</tbody>
		</table>
     </div>   
        <?php echo Assest::js('patient_info');?>