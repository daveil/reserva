APP.controller('AppointmentController',['$scope','dateFilter','api',function($scope,dateFilter,api){
	$scope.minDate = dateFilter(new Date(),'yyyy-MM-dd');
	$scope.disabledDates = ['2016-07-15','2016-07-20'];
	resetAppointment();
	function resetAppointment(){
		$scope.Patient = {};
		$scope.Appointment = {};
		$scope.Appointment.schedule = dateFilter(new Date(),'yyyy-MM-dd');
		$scope.SavingAppointment = false;
	}
	$scope.cancelAppointment = function(){
		resetAppointment();
	}
	$scope.bookAppointment = function(){
		var data = {
				Patient:$scope.Patient,
				Appointment:$scope.Appointment
		};
		$scope.SavingAppointment = true;
		api.POST('appointments/add',data).then(function(response){
				alert(response.data.message);
				if(response.data.status=='OK'){
					resetAppointment();
				}
		});
	}
}]);