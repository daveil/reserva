APP.controller('SettingsController',['$scope','api',function($scope,api){
	var UPLOADER;
	$scope.Days = ['SUN','MON','TUE','WED','THU','FRI','SAT'];
	loadSettings();
	function loadSettings(search){
		$scope.Loading = true;
		api.GET('settings').then(function(response){
			$scope.Loading = false;
			$scope.Settings = response.data;
			$scope.SettingsCopy = angular.copy($scope.Settings);
		});	
	}
	$scope.toggleDay = function(day){
		$scope.Settings.CLINIC_DAYS[day] = !$scope.Settings.CLINIC_DAYS[day];
	}
	$scope.cancelSettings = function(){
		$scope.Settings =  angular.copy($scope.SettingsCopy);
	}
	$scope.saveSettings = function(){
		$scope.Loading = true;
		var data =  $scope.Settings;
		api.POST('settings/edit',data).then(loadSettings);	
	}
	$scope.openUploader = function(type){
		UPLOADER = window.open("uploader?type="+type,"_blank", "width=500,height=300");
	}
}]);