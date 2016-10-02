APP.controller('ProfileController',['$scope','api',function($scope,api){
	$scope.init = function(user){
		var user = user ||{};
		user.patient.contact_no =  parseInt(user.patient.contact_no);
		user.patient.age =  parseInt(user.patient.age);
		$scope.User = user;
		$scope.Patient =  user.patient;
		$scope.PatientCopy =  user.patient;
		$scope.AllowSave  = true;
	}
	$scope.validateLength = function(e){
		var len =$scope.ProfileInfo.contact_no.$viewValue.length;
		
		if(len>=11) e.preventDefault();
	}
	$scope.cancelProfile = function(){
		$scope.Patient =  angular.copy($scope.PatientCopy);
	}
	
	$scope.updateProfile = function(){
		var data = $scope.Patient;
		$scope.Saving = true;
		api.POST('users/edit/profile',data).then(function(response){
			$scope.Saving = false;
			alert(response.data.message);
		});
	}
	$scope.comparePassword = function(){
		var isMatched = $scope.Password.new===$scope.Password.confirm;
		$scope.ErrorMessage = null;
		$scope.AllowChange = isMatched;
		if(!isMatched){
			$scope.ErrorMessage = 'Password mismatch';
		}
	}
	$scope.clearPassword = function(){
		$scope.Password = {};
	}
	$scope.changePassword = function(){
		var data = {
				current:$scope.Password.current,
				change:$scope.Password.confirm
				};
		$scope.Changing = true;
		api.POST('users/edit/password',data).then(function(response){
			$scope.Changing = false;
			alert(response.data.message);
			window.location='logout';
		});
	}
}]);