APP.controller('AppointmentController',['$scope','$http','api',function($scope,$http,api){
	$scope.minDate = new Date();
	$scope.disabledDates = ['2016-07-15','2016-07-01'];
	resetAppointment();
	function resetAppointment(){
		$scope.Patient = {};
		$scope.Appointment = {};
	}
	$scope.cancelAppointment = function(){
		resetAppointment();
	}
	$scope.bookAppointment = function(){
		var data = {
				Patient:$scope.Patient,
				Appointment:$scope.Appointment
		};
		$http.post('http://localhost/reserva/api/appointments/add',data).then(function(response){
				alert(response.data.message);
				if(response.data.status=='OK'){
					resetAppointment();
				}
		});
	}
}]);