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
		$scope.Link = slugify(value);
	});
	function slugify(text){
		  return text.toString().toLowerCase()
			.replace(/\s+/g, '-')           // Replace spaces with -
			.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
			.replace(/\-\-+/g, '-')         // Replace multiple - with single -
			.replace(/^-+/, '')             // Trim - from start of text
			.replace(/-+$/, '');            // Trim - from end of text
	}
}]);