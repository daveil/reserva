(function(){
	const SETTINGS = {
			DEMO_MODE:false,
			API_EXT:'json',
			TEST_URL:'js/tests/',
			API_URL:window.location.host=='localhost'?'http://localhost/reserva/api/':'http://rsrvsys.esy.es/api/'
			};
	APP.constant('settings',SETTINGS);	
})();
