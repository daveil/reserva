APP.controller('CalendarController',['$scope','dateFilter','api',function($scope,dateFilter,api){
	$scope.SelectedDate = dateFilter(new Date(),'yyyy-MM-dd');
	$scope.statusDates = {
			full:[],
			book:[]
	};
	loadDates($scope.SelectedDate);
	$scope.$watch('SelectedDate',function(value){
		loadAppointment(value);
	});
	$scope.toggleCheckbox = function(){
		$scope.CheckAll=!$scope.CheckAll;
		for(var i in $scope.Patients){
			var patient = $scope.Patients[i];
			patient.checked = $scope.CheckAll;
		}
	}
	$scope.print =  function(){
		$scope.openModal = 'Print';
	}
	$scope.move =  function(){
		$scope.openModal = 'Move';
		$scope.NewSelectedDate  =  dateFilter($scope.SelectedDate,'yyyy-MM-dd');
	}
	$scope.delete =  function(){
		$scope.openModal = 'Delete';
	}
	$scope.confirmAction = function(){
		var action = $scope.openModal;
		var data ={};
		var appointments = [];
		//Collect all selected patients
		for(var i in $scope.Patients){
			var patient =  $scope.Patients[i];
			if(patient.checked)
				appointments.push(patient.ref_no);
		}
		data.appointments = appointments;
		switch(action){
			case 'Print':
				runAction('print',data);
			break;
			case 'Move':
				data.schedule =  $scope.$$childTail.NewSelectedDate;
				runAction('edit',data).then(function(response){
					if(response.data.data.success){
						$scope.openModal = null;
						loadAppointment($scope.SelectedDate);
					}
				});
			break;
			case 'Delete':
				runAction('delete',data).then(function(response){
					if(response.data.data.success){
						$scope.openModal = null;
						loadAppointment($scope.SelectedDate);
					}
				});
			break;
		}
	}
	$scope.onChangeMonth=function(date){
		 var formatted = dateFilter(date,'yyyy-MM-dd');
		 $scope.SelectedDate=formatted;
		 loadDates(formatted);
	}
	function loadDates(schedule){
		var data =  {bookings:schedule};
		api.GET('appointments',data).then(function(response){
			$scope.statusDates = response.data;
		});
	}
	function loadAppointment(schedule){
		var data =  {schedule:schedule};
		$scope.Patients = [];
		$scope.Loading = true;
		api.GET('appointments',data).then(function(response){
			$scope.Loading = false;
			var data =  response.data;
			$scope.Patients =  data;
		});
	}
	function runAction(action,data){
		var url =  'appointments/'+action;
		return api.POST(url,data);
	}
}]);
