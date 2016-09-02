<h3 style="margin-top:0;">Profile</h3>
<?php $user = json_encode($_SESSION['user']);?>
<div ng-controller="ProfileController" ng-init='init(<?php echo $user;?>)'>
	<div class="col-md-6">
		<form class="form-vertical col-md-12">
			<h4>Basic Information</h4>
			<div class="form-group">
				<label>Name</label>
				<input type="text" ng-model="Patient.name" class="form-control" />
			</div>
			<div class="form-group">
				<label>Contact No</label>
				<input type="text" ng-model="Patient.contact_no"  class="form-control" />
			</div>
			<div class="form-group">
				<label>Age</label>
				<input type="text" ng-model="Patient.age"   class="form-control" />
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" ng-model="Patient.address"  class="form-control" />
			</div>
		</form>
		<div class="col-md-6"><button class="btn btn-default pull-left" ng-click="cancelProfile()">CANCEL</button></div>
		   <div class="col-md-6"><button class="btn btn-primary pull-right" ng-disabled="!AllowSave || Saving" ng-click="updateProfile()">CONFIRM</button></div>
	</div>
	<div class="col-md-6">
		<form class="form-vertical col-md-12">
			<h4>Login Information</h4>
			<div class="form-group">
				<label>Username</label>
				<input type="text" ng-model="User.username" disabled class="form-control" />
			</div>
			<hr />
			<h6>CHANGE PASSWORD</h6>
			<div class="form-group">
				<label>Current </label>
				<input type="text" ng-model="Password.current" class="form-control" />
			</div>
			<div class="form-group">
				<label>New </label>
				<input type="text" ng-model="Password.new" class="form-control" />
			</div>
			<div class="form-group">
				<label>Confirm </label>
				<input type="text" ng-model="Password.confirm" ng-blur="comparePassword()" class="form-control" />
			</div>
			<div class="alert alert-danger" ng-if="ErrorMessage">{{ErrorMessage}}</div>
		</form>
		<div class="col-md-6"><button class="btn btn-default pull-left" ng-click="clearPassword()">CANCEL</button></div>
		   <div class="col-md-6"><button class="btn btn-primary pull-right" ng-disabled="!AllowChange || Changing" ng-click="changePassword()">CONFIRM</button></div>
	</div>
</div>
<?php echo Assest::js('profile');?>