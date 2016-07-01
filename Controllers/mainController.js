
app.controller("mainController",function($scope,mainFactory){
	$scope.message = mainFactory.getMessage();
	
	$scope.connect = function(User){
		mainFactory.connect(User);
		$scope.User.pass = '';
	}
	
	$scope.register = function(Ets){
		mainFactory.register(Ets);
		$scope.Ets.nom = '';
		
	}
})
; 