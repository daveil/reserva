APP.controller('SettingsController',['$scope','api',function($scope,api){
	var UPLOADER;
	$scope.Days = ['SUN','MON','TUE','WED','THU','FRI','SAT'];
	$scope.Hours = (function(){
		var hours =[];
		for(var h=0;h<24;h++){	
			var hr = (h%12)+':00 ';
			if(h==0)
				hr='12:00 ';
			else if(h%12<10&&h!=0) 
				hr ='0'+ hr;
			hr+= h>12?'PM':'AM';
			hours.push({id:h,name:hr});
		}
		return hours;
	})();
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
	window.addEventListener('message', function(event) {
		$scope.$apply(function(){
			if(event.data.type=='background')
			$scope.Settings.BACKGROUND  = event.data.file;
		});
	}, false);
}]);