APP.controller('PatientsController',['$scope','api',function($scope,api){
	loadPatients();
	function loadPatients(search){
		var data = {};
			if(search){
				data.search=search;
			}
		$scope.Searching = true;
		$scope.Records=[];
		api.GET('patients',data).then(function(response){
			$scope.Searching = false;
			$scope.Records = response.data;
		});	
	}
	$scope.search = function(){
		var search =  $scope.SearchPatient;
		loadPatients(search);
	}
}]);