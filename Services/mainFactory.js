/**
 * 
 */
app.factory("mainFactory",function(){
	var message = "Hello from factory";
	
	var getMessage = function(){
		return message;
	};
	
	var connect = function(User){
		
	};
	
	var register = function($Ets){
		$log.info($Ets);
	};
	
	return {
		getMessage: getMessage,
		connect: connect,
		register: register
	}
});