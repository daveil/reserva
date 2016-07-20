APP.controller('AppointmentController',['$scope','dateFilter','api',function($scope,dateFilter,api){
	resetAppointment();
	$scope.minDate = dateFilter(new Date(),'yyyy-MM-dd');
	$scope.disabledDates = ['2016-07-15','2016-07-20'];
	function resetAppointment(){
		$scope.Patient = {};
		$scope.Appointment = {};
		$scope.SavingAppointment = false;
	}
	$scope.cancelAppointment = function(){
		resetAppointment();
	}
	$scope.$watch('SelectedDate',function(value){
		$scope.Appointment.schedule = value;
	});
	$scope.bookAppointment = function(){
		var data = {
				Patient:$scope.Patient,
				Appointment:$scope.Appointment
		};
		/*
		{
			Patient: {
				name: "Juan",
				age:15,
			}
		}
		*/
		$scope.SavingAppointment = true;
		api.POST('appointments/add',data).then(function(response){
				alert(response.data.message);
				if(response.data.status=='OK'){
					resetAppointment();
				}
		});
	}
}]);