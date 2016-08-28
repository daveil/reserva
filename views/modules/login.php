<div class="row">
	 <div class="col-md-6" ng-controller="LoginController">
		  <form name="Login" class="form-vertical col-md-12">
			  <div class="form-group">
				<label for="">Username</label>
				<input type="text" name="username" ng-model="Username" class="form-control">
			  </div>
			  <div class="form-group">
				<label for="">Password</label>
				<input type="password" name="password" ng-model="Password" class="form-control">
			  </div>
			   <span ng-if="ErrorMessage">{{ErrorMessage}}</span>
		  </form>  
		 
		  <div class="col-md-6"><button class="btn btn-default pull-left" ng-click="cancel()">CANCEL</button></div>
		   <div class="col-md-6"><button class="btn btn-primary pull-right" ng-click="login()">LOGIN</button></div>
	</div>
	<div class="col-md-6" ng-controller="RegisterController">
		  <form name="Register" class="form-vertical col-md-12">
			  <div class="form-group">
				<label for="">Username</label>
				<input type="text" name="username" ng-model="Username" class="form-control">
			  </div>
			  <div class="form-group">
				<label for="">Password</label>
				<input type="password" name="password" ng-model="Password"  class="form-control">
			  </div>
			   <div class="form-group">
				<label for="">Confirm</label>
				<input type="password" name="confirm_password" ng-model="ConfirmPassword" class="form-control" ng-blur="comparePassword()">
			  </div>
			  <span ng-if="ErrorMessage">{{ErrorMessage}}</span>
		  </form>  
		  <div class="col-md-6"><button class="btn btn-default pull-left" ng-click="cancel()">CANCEL</button></div>
		  <div class="col-md-6"><button class="btn btn-primary pull-right" ng-disabled="!AllowRegister" ng-click="register()">REGISTER</button></div>
	</div>
</div>
<?php echo Assest::js('login');?>