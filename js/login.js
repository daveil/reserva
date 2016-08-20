APP.controller('LoginController',['$scope','api',function($scope,api){
	$scope.cancel = function(){
		$scope.Username = null;
		$scope.Password = null;
	}
	$scope.login = function(){
		var data = {};
			data.username =  $scope.Username;
			data.password =  $scope.Password;
		api.POST('login',data).then(function(response){
			switch(response.data.status){
				case 'OK':
					//Refresh page
					window.location.href = window.location.href;
				break;
				case 'ERROR':
					//Display error
					$scope.ErrorMessage = response.data.message;
				break;
			}
		});
	}
}]);
APP.controller('RegisterController',['$scope','api',function($scope,api){
	$scope.cancel = function(){
		$scope.AllowRegister = false;
		$scope.Username = null;
		$scope.Password = null;
		$scope.ConfirmPassword = null;
		$scope.ErrorMessage = null;
	}
	$scope.comparePassword = function(){
		var isMatched = $scope.Password===$scope.ConfirmPassword;
		$scope.ErrorMessage = null;
		$scope.AllowRegister = isMatched;
		if(!isMatched){
			$scope.ErrorMessage = 'Password mismatch';
		}
		
	}
	$scope.register = function(){
		var data = {};
			data.username =  $scope.Username;
			data.password =  $scope.ConfirmPassword;
		$scope.AllowRegister = false;
		api.POST('register',data).then(function(response){	
			switch(response.data.status){
				case 'OK':
					//Refresh page
					window.location.href = window.location.href;
				break;
				case 'ERROR':
					//Display error
					$scope.AllowRegister = true;
					$scope.ErrorMessage = response.data.message;
				break;
			}
		});
	}
}]);