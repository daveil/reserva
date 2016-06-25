APP.controller('CalendarController',['$scope','api',function($scope,api){
	$scope.SelectedDate = new Date();

	api.GET('patients').then(function(response){
		var data =  response.data;
		$scope.Patients =  data;
	});

	$scope.toggleCheckbox = function(){
		$scope.CheckAll=!$scope.CheckAll;
		for(var i in $scope.Patients){
			var patient = $scope.Patients[i];
			patient.checked = $scope.CheckAll;
		}
	}
	$scope.print =  function(){
		$scope.openModal = 'print';
	}
	$scope.move =  function(){
		$scope.openModal = 'move';
	}
	$scope.delete =  function(){
		$scope.openModal = 'delete';
	}
}]);