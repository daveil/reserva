var CAL = angular.module('Calendar',[]);
CAL.controller('CalendarController',function($scope){
	$scope.SelectedDate = new Date();
});