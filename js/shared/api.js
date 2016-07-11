APP.factory('api',['$http','settings',function($http,settings){

	const EXT  =  settings.API_EXT;
	const API  =  settings.API_URL;
	const TEST =  settings.TEST_URL;

	function HTTP(method,url,data){
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
					  data:data,
					  headers: {
					   'X-Requested-With': 'XMLHttpRequest',
					   'Content-Type': 'application'+EXT,
					   'Accepts': 'application/'+EXT
						}
					};
		if(method=='GET'){
			request.params =  request.data;
		}
		return $http(request);
	}
	function POST(url,data){
		return HTTP('POST',url,data);
	}
	function GET(url,data){
		return HTTP('GET',url,data);
	}
	return{
		POST:POST,
		GET:GET,
	};
}]);