APP.controller('AppointmentController',['$scope','dateFilter','api',function($scope,dateFilter,api){
	$scope.init = function(user){
		var user = user ||{};
		if(user.patient){
			user.patient.contact_no =  parseInt(user.patient.contact_no);
			user.patient.age =  parseInt(user.patient.age);
		}
		$scope.minDate = dateFilter(new Date(),'yyyy-MM-dd');
		setClinicDays();
		resetAppointment();
		$scope.ShowModal = false;
		$scope.User = user;
		$scope.Patient =  user.patient;
		$scope.PatientCopy =  user.patient;
	}
	
	function resetAppointment(sched,keepPatient){
		$scope.RefNo = null;
		if(!keepPatient) $scope.Patient = {};
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
		api.GET('settings?clinic_sched').then(function(response){
			$scope.SelectedDate = dateFilter(new Date(),'yyyy-MM-dd');
			$scope.clinicDays =  response.data.days;
			$scope.clinicHours =  response.data.hours;
			getDisabledDates($scope.SelectedDate);
		});
	}
	$scope.validateLength = function(e){
		try{
			var len =$scope.AppointmentForm.contact_no.$viewValue.length;
			if(len>=11) e.preventDefault();
		}catch(e){
			//Error handling
		}
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
		console.log($scope.AppointmentForm);
		if($scope.AppointmentForm.$invalid) return alert('Please complete form.');
		if(!$scope.User.id){
			$scope.ShowLogin =true;
			$scope.openLoginModal = true;
			return;
		}
		
		bookAppointment();
	}
	$scope.closeModal = function(){
		$scope.RefNo=null;
		$scope.ShowModal=false;
		$scope.ModalMessage =  null;
		$scope.AppointmentStatus =null;
		$scope.SavingAppointment = false;
		if($scope.Token)
			window.location.href =  window.location.href.replace('appointment','login')+'?token='+$scope.Token;
	}
	$scope.dismissLogin = function(){
		$scope.openLoginModal = false;
		$scope.ShowLogin = false;
	}
	$scope.printRefNo = function(){
		window.open('api/appointments/ref_no?id='+$scope.AID,'_blank');
	}
	$scope.login = function(){
		var data = {};
			data.username =  $scope.Username;
			data.password =  $scope.Password;
			$scope.ErrorMessage=null;
			if(!data.username&&!data.password){
				$scope.ErrorMessage ="Username password required";
				return;
			}
		api.POST('login',data).then(function(response){
			switch(response.data.status){
				case 'OK':
					//Refresh page
					var data= response.data.data;
					$scope.User.id = data.id;
					$scope.Patient.id = data.patient_id;
					bookAppointment(data.token);
				break;
				case 'ERROR':
					//Display error
					$scope.ErrorMessage = response.data.message;
				break;
			}
		});
	}
	$scope.register = function(){
		var data = {};
			data.name =  $scope.Patient.name;
			data.contact_no =  $scope.Patient.contact_no;
			data.username =  $scope.Username;
			data.password =  $scope.Password;
			if(!data.username&&!data.password){
				$scope.ErrorMessage ="Username password required";
				return;
			}
		$scope.AllowRegister = false;
		api.POST('register',data).then(function(response){	
			switch(response.data.status){
				case 'OK':
					//Refresh page
					var data= response.data.data;
					$scope.User.id = data.id;
					$scope.Patient.id = data.patient_id;
					bookAppointment(data.token);
				break;
				case 'ERROR':
					//Display error
					$scope.AllowRegister = true;
					$scope.ErrorMessage = response.data.message;
				break;
			}
		});
	}
	function bookAppointment(token){
		$scope.ShowLogin =false;
		$scope.openLoginModal = false;
		$scope.Token=null;
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
					resetAppointment(response.data.data.Appointment.schedule,true);
					$scope.PatientCopy =  angular.copy($scope.Patient);
					$scope.RefNo = response.data.data.Appointment.ref_no;
					$scope.AID =response.data.data.Appointment.id;
					if(token)
						$scope.Token = token;
				}
		});
	}
}]);