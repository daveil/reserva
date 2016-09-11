APP.controller('UsersController',['$scope','api',function($scope,api){
	loadUsers();
	function loadUsers(search){
		var data = {};
			if(search){
				data.search=search;
			}
		$scope.Searching = true;
		$scope.Records=[];
		api.GET('users',data).then(function(response){
			$scope.Searching = false;
			$scope.Records = response.data;
		});	
	}
	$scope.search = function(){
		var search =  $scope.SearchUser;
		loadUsers(search);
	}
	$scope.toggleCheckbox = function(){
		$scope.CheckAll=!$scope.CheckAll;
		for(var i in $scope.Records){
			var user = $scope.Records[i];
			user.checked = $scope.CheckAll;
		}
	}
	$scope.makeUser =  function(type){
		$scope.openModal = 'Make '+type.toUpperCase();
	}
	$scope.resetpass =  function(){
		$scope.openModal = 'Reset password';
	}
	$scope.confirmAction = function(){
		var action = $scope.openModal;
		var data ={};
		var users = [];
		//Collect all selected record
		for(var i in $scope.Records){
			var user =  $scope.Records[i];
			if(user.checked)
				users.push(user.User.id);
		}
		data.users = users;
		switch(action){
			case 'Reset password':
				api.POST('users/edit/resetpass',data).then(function(response){
					alert(response.data.message);
					if(response.data.status=='OK'){
						$scope.openModal=null;
						loadUsers();
					}
				});
			break;
			case 'Make ADMIN':
			case 'Make PATIENT':
				data.type = action==='Make ADMIN'?'admin':'patient';
				api.POST('users/edit/mkusr',data).then(function(response){
					alert(response.data.message);
					if(response.data.status=='OK'){
						$scope.openModal=null;
						loadUsers();
					}
						
				});
			break;
			
		}
	}
	
	
}]);