APP.controller('CalendarController',['$scope','api',function($scope,api){
	$scope.SelectedDate = new Date();
	api.GET('patients').then(function(response){
		var data =  response.data;
		$scope.Patients =  data;
	});
}]);