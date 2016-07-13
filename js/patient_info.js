APP.controller('PatientInfoController',['$scope','api',function($scope,api){
	$scope.$watch('PatientId',function(value){
		api.GET('patients/view/'+value).then(function(response){
			$scope.Patient = response.data.Patient;
			$scope.Appointments = response.data.Appointment;
		});	
	});
	
}]);