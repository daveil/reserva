(function(angular){
	//Initialize APP
	const APP = angular.module('APP',['pickadate','summernote']);
	window.APP = APP;
	//Load library
	(function(){
		//Declare constants
		const BODY = angular.element(document).find('body');
		const LIB_PATH = 'js/shared/';
		const LIBS = ['settings','api'];
		const JS_PATH = 'js/';

		//Loop all libs file to be included
		//for(var i in LIBS)
		//	appendJS(LIB_PATH+LIBS[i]+'.js');
		 
		//Append script tag to body
		function appendJS(jsFilePath){
			var breakCache =  Math.random();
			var js = document.createElement("script");
			js.type = "text/javascript";
			js.src = jsFilePath+'?'+breakCache;
			document.body.appendChild(js);
		}
	})();
})(window.angular);