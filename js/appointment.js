APP.controller('AppointmentController',['$scope','dateFilter','api',function($scope,dateFilter,api){
	$scope.init = function(user){

		$scope.minDate = dateFilter(new Date(),'yyyy-MM-dd');
		setClinicDays();
		resetAppointment();
		$scope.ShowModal = false;
		$scope.User = user;
		$scope.Patient =  user.patient;
		$scope.PatientCopy =  user.patient;
	}
	
	function resetAppointment(sched){
		$scope.RefNo = null;
		$scope.Patient = {};
		$scope.Appointment = {};
		$scope.SavingAppointment = false;
		if(sched){
			$scope.SelectedDate = sched;
			$scope.Appointment.schedule = sched;
		}
	}
	function getDisabledDates(date){
		api.GET('disabled_dates/index/'+date).then(function(response){
			$scope.disabledDates = response.data;
		});
	}
	function setClinicDays(){
		api.GET('settings?clinic_days').then(function(response){
			$scope.SelectedDate = dateFilter(new Date(),'yyyy-MM-dd');
			$scope.clinicDays =  response.data;
			getDisabledDates($scope.SelectedDate);
		});
	}
	$scope.cancelAppointment = function(){
		resetAppointment();
	}
	$scope.$watch('SelectedDate',function(value){
		$scope.Appointment.schedule = value;
	});
	$scope.onChangeMonth=function(date){
		 var formatted = dateFilter(date,'yyyy-MM-dd');
		 $scope.SelectedDate = formatted;
		 getDisabledDates(formatted);
	}
	$scope.bookAppointment = function(){
		var data = {
				Patient:$scope.Patient,
				Appointment:$scope.Appointment
		};
		$scope.SavingAppointment = true;
		api.POST('appointments/add',data).then(function(response){
				$scope.AppointmentStatus=response.data.status;
				$scope.ShowModal=true;
				$scope.ModalMessage = response.data.message;
				if($scope.AppointmentStatus =='OK'){
					resetAppointment(response.data.data.Appointment.schedule);
					$scope.Patient =  angular.copy($scope.PatientCopy);
					$scope.RefNo = response.data.data.Appointment.ref_no;
				}
		});
	}
	$scope.closeModal = function(){
		$scope.RefNo=null;
		$scope.ShowModal=false;
		$scope.ModalMessage =  null;
		$scope.AppointmentStatus =null;
		$scope.SavingAppointment = false;
	}
	$scope.printRefNo = function(){
		window.open('api/appointments/ref_no?id='+$scope.RefNo,'_blank');
	}
}]);