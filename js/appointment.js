APP.controller('AppointmentController',['$scope','dateFilter','api',function($scope,dateFilter,api){
	$scope.minDate = dateFilter(new Date(),'yyyy-MM-dd');
	setClinicDays();
	getDisabledDates($scope.SelectedDate);
	resetAppointment();
	$scope.ShowModal = false;
	function resetAppointment(sched){
		$scope.Patient = {};
		$scope.Appointment = {};
		$scope.SavingAppointment = false;
		if(sched){
			$scope.SelectedDate = sched;
			$scope.Appointment.schedule = sched;
		}
	}
	function getDisabledDates(date){
		api.GET('appointments/disabled/'+date,function(response){
			console.log(response.data);
		});
	}
	function setClinicDays(){
		api.GET('settings?clinic_days').then(function(response){
			$scope.SelectedDate = dateFilter(new Date(),'yyyy-MM-dd');
			$scope.disabledDates = ['2016-07-15','2016-07-20'];
			$scope.clinicDays =  response.data;
		});
	}
	$scope.cancelAppointment = function(){
		resetAppointment();
	}
	$scope.$watch('SelectedDate',function(value){
		$scope.Appointment.schedule = value;
	});
	$scope.onChangeMonth=function(date){
		 dateFilter(date,'yyyy-MM-dd')
	}
	$scope.bookAppointment = function(){
		var data = {
				Patient:$scope.Patient,
				Appointment:$scope.Appointment
		};
		$scope.SavingAppointment = true;
		api.POST('appointments/add',data).then(function(response){
				$scope.ShowModal=true;
				$scope.ModalMessage = response.data.message;
				if(response.data.status=='OK'){
					resetAppointment(response.data.data.Appointment.schedule);
				}
		});
	}
	$scope.closeModal = function(){
		$scope.ShowModal=false;
		$scope.ModalMessage =  null;
	}
}]);