APP.controller('ContentController',['$scope','api',function($scope,api){
	loadContent();
	$scope.ComposerOptions = {
		 height: 250,
		 focus: true,
		 toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear']],
			['para', ['ul', 'ol', 'paragraph']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['fontface', ['fontname']],
			['edit',['undo','redo']],
            ['view', ['fullscreen', 'codeview']],
			['help', ['help']]
			]
	};
	$scope.$watch('Title',function(value){
		if(value) $scope.Link = slugify(value);
	});
	$scope.toggleCheckbox = function(){
		$scope.CheckAll=!$scope.CheckAll;
		for(var i in $scope.Contents){
			var content = $scope.Contents[i];
			content.checked = $scope.CheckAll;
		}
	}
	$scope.edit = function(content){
		$scope.ContentId = content.id;
		$scope.Title = content.title;
		$scope.Link = content.slug;
		$scope.ContentText = content.content;
	}
	$scope.cancel=function(){
		$scope.ContentId = null;
		$scope.Title = null;
		$scope.Link = null;
		$scope.ContentText = null;
	}
	$scope.save = function(status){
		var data = {
			id:$scope.ContentId,
			title:$scope.Title,
			slug:$scope.Link,
			content:$scope.ContentText,
			status:status,
		}
		api.POST('contents/add',data).then(function(response){
			$scope.openModal = response.data.status =='OK'?'Success':'Warning';
			$scope.modalMessage = response.data.message;
			if( response.data.status =='OK'){
				loadContent();
			}
		});
	}
	function loadContent(){
		api.GET('contents').then(function(response){
			$scope.Contents = response.data;
		});
	}
	function slugify(text){
		  return text.toString().toLowerCase()
			.replace(/\s+/g, '-')           // Replace spaces with -
			.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
			.replace(/\-\-+/g, '-')         // Replace multiple - with single -
			.replace(/^-+/, '')             // Trim - from start of text
			.replace(/-+$/, '');            // Trim - from end of text
	}
}]);