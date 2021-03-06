APP.controller('HistoryController',['$scope','dateFilter','api',function($scope,dateFilter,api){
	loadHistory();
	function loadHistory(search){
		var data = {};
			if(search){
				data.search=search;
			}
		$scope.Searching = true;
		$scope.Records=[];
		api.GET('appointments?history',data).then(function(response){
			$scope.Searching = false;
			$scope.Records = response.data;
		});
	api.GET('settings?clinic_sched').then(function(response){
			$scope.clinicDays =  response.data.days;
			$scope.clinicHours =  response.data.hours;
		});		
	}
	$scope.search = function(){
		var search =  $scope.SearchPatient;
		loadHistory(search);
	}
	$scope.cancel  = function(index){
		var record = $scope.Records[index].Appointment;
		record.upadting = true;
		$scope.ActiveRecord = record;
		$scope.openModal='Cancel';
	}
	$scope.resched  = function(index){
		var record = $scope.Records[index].Appointment;
		var sched = new Date(record.schedule+' '+record.timeslot);
		record.upadting = true;
		$scope.ActiveRecord = record;
		$scope.openModal='Move';
		$scope.NewSelectedDate  =  dateFilter(sched,'yyyy-MM-dd');
		$scope.NewTimeSlot  =  dateFilter(sched,'h:mm');
	}
	$scope.confirmAction = function(){
		switch($scope.openModal){
			case 'Cancel':
				cancelAppointment($scope.ActiveRecord);
			break;
			case 'Move':
				$scope.ModalMessage = null;
				var sched =  $scope.$$childTail.NewSelectedDate;
				var timeslot =  $scope.$$childTail.NewTimeSlot;
				var data = {id:$scope.ActiveRecord.id,schedule:sched,timeslot:timeslot};
				api.POST('appointments/edit?history',data).then(function(response){
					if(response.data.status=='OK'){
						$scope.openModal = null;
						var data = response.data.data.Appointment;
						$scope.ActiveRecord.schedule = data.schedule;
						$scope.ActiveRecord.status = data.status;
					}else{
						$scope.ModalMessage =  response.data.message;
					}
				});
			break;
		}
	}
	$scope.dismissMessage = function(){
		$scope.ModalMessage=null;
	}
	function cancelAppointment(record){
		var status = 'cancelled';
		var data = {id:record.id,status:status};
		api.POST('appointments/edit?history',data).then(function(response){
			record.status = status;
			record.updating = false;
			$scope.openModal = null;
		});
	}
}]);