APP.controller('HistoryController',['$scope','api',function($scope,api){
	loadHistory();
	function loadHistory(search){
		var data = {};
			if(search){
				data.search=search;
			}
		$scope.Searching = true;
		$scope.Records=[];
		api.GET('appointments?history',data).then(function(response){
			$scope.Searching = false;
			$scope.Records = response.data;
		});	
	}
	$scope.search = function(){
		var search =  $scope.SearchPatient;
		loadHistory(search);
	}
}]);