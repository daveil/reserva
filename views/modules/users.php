<h2 style="margin-top:0;">Users</h2>
<div ng-controller="UsersController">
	<div class="row">
	  <div class="col-md-12">
		  <div class="input-group">
			<input type="text" placeholder="Search user" class="form-control" ng-model="SearchUser">
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
		<div class="col-md-12">
			<table class="table"> 
				  <thead>
					<tr>
					  <th><input type="checkbox" ng-click="toggleCheckbox()"/></th>
					  <th>Name</th>
					  <th>Type</th>
					</tr>
				  </thead>
				  <tbody>
					<tr ng-repeat="Record in Records" ng-if="Records.length" >
					  <td>
						  <input type="checkbox" ng-model="Record.checked" ng-checked="CheckAll"/>
					  </td>
					  <td>{{Record.User.username}}</td>
					  <td>{{Record.User.type}}</td>
					</tr>
					<tr ng-if="!Records.length">
						
							<td colspan="4" class="text-center">{{Searching?'Loading...':'No users found'}}</td>
					
					</tr>
				  </tbody>
			</table>
			<div class="row" style="padding:1rem;">
			  <div class="col-md-4">
				  <button class="btn btn-success btn-block" ng-disabled="!Records.length" ng-click="makeUser('patient')">MAKE PATIENT</button>
			  </div>
			  <div class="col-md-4">
				<button class="btn btn-warning btn-block" ng-disabled="!Records.length" ng-click="resetpass()">RESET PASSWORD</button>
			  </div>
			  <div class="col-md-4">
				<button class="btn btn-danger btn-block"  ng-disabled="!Records.length" ng-click="makeUser('admin')">MAKE ADMIN</button>
			  </div>
			</div>
		</div>
	</div>
	<div class="modal-blind" ng-class="{show:openModal}"></div>
	<div class="modal" ng-class="{show:openModal}">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">{{openModal}}</h4>
			</div>
			<div class="modal-body">
				<div class="row" >
					<div class="col-md-12">
						<div ng-if="openModal==='Reset password'">
						  Are you sure you want to reset password?
						</div>
						<div ng-if="openModal==='Make PATIENT'">
						  Are you sure you want to make selected user(s) <b>patient</b>?
						</div>
						 <div ng-if="openModal==='Make ADMIN'">
						  Are you sure you want to make selected user(s) <b>admin</b>?
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
<?php echo Assest::js('users');?>