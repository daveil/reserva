APP.controller('SettingsController',['$scope','api',function($scope,api){
	loadSettings();
	function loadSettings(search){
		api.GET('settings').then(function(response){
			$scope.Settings = response.data;
		});	
	}
}]);