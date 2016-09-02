<h3 style="margin-top:0;">Profile</h3>
<div ng-controller="ProfileController">
	<div class="col-md-6">
		<form class="form-vertical col-md-12">
			<h4>Basic Information</h4>
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" />
			</div>
			<div class="form-group">
				<label>Contact No</label>
				<input type="text" class="form-control" />
			</div>
			<div class="form-group">
				<label>Age</label>
				<input type="text" class="form-control" />
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" class="form-control" />
			</div>
		</form>
		<div class="col-md-6"><button class="btn btn-default pull-left" ng-click="cancel()">CANCEL</button></div>
		   <div class="col-md-6"><button class="btn btn-primary pull-right" ng-click="confirm()">CONFIRM</button></div>
	</div>
	<div class="col-md-6">
		<form class="form-vertical col-md-12">
			<h4>Login Information</h4>
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" />
			</div>
			<div class="form-group">
				<label>Current Password</label>
				<input type="text" class="form-control" />
			</div>
			<div class="form-group">
				<label>New Password</label>
				<input type="text" class="form-control" />
			</div>
			<div class="form-group">
				<label>Confirm Password</label>
				<input type="text" class="form-control" />
			</div>
		</form>
		<div class="col-md-6"><button class="btn btn-default pull-left" ng-click="cancel()">CANCEL</button></div>
		   <div class="col-md-6"><button class="btn btn-primary pull-right" ng-click="confirm()">CONFIRM</button></div>
	</div>
</div>
<?php echo Assest::js('profile');?>