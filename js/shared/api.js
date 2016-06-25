APP.factory('api',['$http','settings',function($http,settings){

	const EXT  =  settings.API_EXT;
	const API  =  settings.API_URL;
	const TEST =  settings.TEST_URL;

	function HTTP(method,url){
		if(settings.DEMO_MODE){
			method =  'GET';
			url =TEST+url+'.'+EXT;
		}else{
			url =API+url;
		}
		var request ={
					  method: method,
					  url: url,
					  dataType:EXT,
					  headers: {
					   'X-Requested-With': 'XMLHttpRequest',
					   'Content-Type': 'application'+EXT,
					   'Accepts': 'application/'+EXT
						}
					};
		return $http(request);
	}
	function POST(url){
		return HTTP('POST',url);
	}
	function GET(url){
		return HTTP('GET',url);
	}
	return{
		POST:POST,
		GET:GET,
	};
}]);