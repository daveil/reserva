APP.controller('CalendarController',['$scope','dateFilter','api',function($scope,dateFilter,api){
	$scope.SelectedDate = dateFilter(new Date(),'yyyy-MM-dd');
	$scope.$watch('SelectedDate',function(){
		console.log('fsadfs');
		var data =  {schedule:$scope.SelectedDate};	
		api.GET('appointments',data).then(function(response){
			var data =  response.data;
			$scope.Patients =  data;
		});
	});
	$scope.toggleCheckbox = function(){
		$scope.CheckAll=!$scope.CheckAll;
		for(var i in $scope.Patients){
			var patient = $scope.Patients[i];
			patient.checked = $scope.CheckAll;
		}
	}
	$scope.print =  function(){
		$scope.openModal = 'Print';
	}
	$scope.move =  function(){
		$scope.openModal = 'Move';
	}
	$scope.delete =  function(){
		$scope.openModal = 'Delete';
	}
}]);