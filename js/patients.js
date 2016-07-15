APP.controller('PatientsController',['$scope','api',function($scope,api){
	api.GET('patients').then(function(response){
		$scope.Records = response.data;
	});	
}]);