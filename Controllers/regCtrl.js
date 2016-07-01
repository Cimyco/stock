'use strict';

app.controller('regCtrl',function($scope,$http){
	$scope.inputdata = function(){
		
		if(this.regform.$valid)
            {
                $http.post("../Controllers/insert.php",{'login':$scope.login,'mdp':$scope.pass, 'email':$scope.email, 'taille':$scope.etstaille,
                                                 'nom':$scope.etsnom, 'pays':$scope.etspays, 'tel':$scope.etstel})
                .success(function(data,status,headers,config){
                console.log(data);
                 
                })
                .error(function(data,status,headers,config){
                    // $scope.regform.login.$setValidity("usedlogin",false);
                }) 
            }
        else {}
		
	}


});

