APP.controller('LoginController',['$scope','api',function($scope,api){
	$scope.cancel = function(){
		$scope.Username = null;
		$scope.Password = null;
	}
	$scope.login = function(){
		var data = {};
			data.username =  $scope.Username;
			data.password =  $scope.Password;
		api.POST('login',data,function(response){
			
		});
	}
}]);
APP.controller('RegisterController',['$scope','api',function($scope,api){
	$scope.cancel = function(){
		$scope.Username = null;
		$scope.Password = null;
	}
	$scope.register = function(){
		var data = {};
			data.username =  $scope.Username;
			data.password =  $scope.ConfirmPassword;
		api.POST('register',data,function(response){
			
		});
	}
}]);