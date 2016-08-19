APP.controller('ContentController',['$scope','api',function($scope,api){
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
	$scope.save = function(status){
		var data = {
			id:$scope.ContentId,
			title:$scope.Title,
			slug:$scope.Link,
			content:$scope.ContentText,
			status:status,
		}
		api.POST('contents/add',data).then(function(response){
			console.log(response);
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