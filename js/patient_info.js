APP.controller('PatientInfoController',['$scope','api',function($scope,api){
	$scope.$watch('PatientId',function(value){
		api.GET('patients/view/'+value).then(function(response){
			$scope.Patient = response.data.Patient;
			$scope.PatientCopy = response.data.Patient;
			$scope.Appointments = response.data.Appointment;
		});	
	});
	$scope.Mode = 'VIEW';
	$scope.edit = function(){
		$scope.Mode ='EDIT';
	}
	$scope.cancel = function(){
		$scope.Mode = 'VIEW';
		$scope.Patient = angular.copy($scope.PatientCopy);
	}
	$scope.updateInfo = function(){
		var data = $scope.Patient;
		$scope.Saving = true;
		api.POST('users/edit/profile',data).then(function(response){
			$scope.Saving = false;
			$scope.PatientCopy =  angular.copy($scope.Patient);
			alert(response.data.message);
		});
	}
	
}]);