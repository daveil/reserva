APP.controller('CalendarController',['$scope','dateFilter','api',function($scope,dateFilter,api){
	$scope.SelectedDate = dateFilter(new Date(),'yyyy-MM-dd');
	$scope.statusDates = {
			full:[],
			book:[]
	};
	$scope.IsEnabled = true;
	loadBookings($scope.SelectedDate);
	$scope.$watch('SelectedDate',function(value){
		loadSchedules(value);
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
		$scope.ModalMessage = null;
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
				var  ids = data.appointments.join(',');
				var date =  $scope.SelectedDate;
				window.open('api/appointments/report?ids='+ids+"&date="+date,'_blank');
				$scope.openModal = null;
			break;
			case 'Move':
				$scope.ModalMessage = null;
				data.schedule =  $scope.$$childTail.NewSelectedDate;
				runAction('edit?sched',data).then(function(response){
					$scope.CheckAll = false;
					$scope.ToggleCheckbox = false;
					if(response.data.status=='OK'){
						$scope.openModal = null;
						$scope.SelectedDate = data.schedule;
					}else{
						$scope.ModalMessage =  response.data.message;
					}
					loadSchedules($scope.SelectedDate);
					loadBookings($scope.SelectedDate);
				});
				
			break;
			case 'Delete':
				runAction('delete',data).then(function(response){
					if(response.data.data.success){
						$scope.openModal = null;
						loadSchedules($scope.SelectedDate);
						loadBookings($scope.SelectedDate);
					}
				});
			break;
		}
	}
	$scope.onChangeMonth=function(date){
		 var formatted = dateFilter(date,'yyyy-MM-dd');
		 $scope.SelectedDate=formatted;
		 loadBookings(formatted);
	}
	$scope.toggleStatus = function(schedule){
		$scope.IsEnabled = !$scope.IsEnabled;
		var data = {date:schedule,status:$scope.IsEnabled?'enabled':'disabled'};
		$scope.Loading = true;
		api.POST('disabled_dates/edit',data).then(function(response){
			$scope.Loading = false;
			loadBookings(schedule);
		});
	}
	function loadBookings(schedule){
		var data =  {bookings:schedule};
		api.GET('appointments',data).then(function(response){
			$scope.statusDates = response.data;
		});
	}
	function loadSchedules(schedule){
		var data =  {schedule:schedule};
		$scope.Patients = [];
		$scope.Loading = true;
		api.GET('appointments',data).then(function(response){
			$scope.Loading = false;
			var data =  response.data;
			$scope.IsEnabled = data.status;
			$scope.Patients =  data.appointments;
		});
	}
	function runAction(action,data){
		var url =  'appointments/'+action;
		return api.POST(url,data);
	}
}]);
