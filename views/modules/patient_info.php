	<h2 style="margin-top:0;">Patient Information</h2>
	<div ng-controller="PatientInfoController" ng-init="PatientId=<?php echo $params[0];?>">
		<div class="row" >
			<div class="col-md-4">
			 <dl>
			   <dt>Name</dt>
			   <dd>{{Patient.name}}</dd>
			   <dt>Age</dt>
			   <dd>{{Patient.name}}</dd>
			   <dt>Address</dt>
			   <dd>{{Patient.address}}</dd>
			 </dl>
			</div>
			<div class="col-md-8">
			  <dl>
			   <dt>Contact No</dt>
			   <dd>{{Patient.contact_no}}</dd>
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