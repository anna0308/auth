angular.module('myApp').controller('LoginController',
    ['$scope', '$http', '$state','$location', '$rootScope', function($scope, $http, $state, $location, $rootScope) {
    	$scope.inputs = {};
    	$rootScope.user = '';
    	$rootScope.loggedIn = false;
	    $scope.submit = function(inputs) {
	    
	        $http.post('/api/login', $scope.inputs)
	        .then(
	        	function(response) { 
	        	
		            localStorage.setItem('id',response.data.user.id)
	               	localStorage.setItem('user',response.data.user.name);
	                $rootScope.user = localStorage['user'];
	                $rootScope.id = localStorage['id'];
	                localStorage.setItem('loggedIn',true);
	                $rootScope.loggedIn = localStorage['loggedIn'];
			            
		            $state.go('home');
		            
	            }, 
	            function(response) {

	                $scope.status = response.data.status;
	             
	           	}
	        ); 
	    }
	    $rootScope.user = localStorage['user'];
    	$rootScope.id = localStorage['id'];
    	$rootScope.loggedIn = localStorage['loggedIn'];
    	$scope.logout = function() {
	        
	 		localStorage.clear();
	        $rootScope.loggedIn = false;
	        $state.go('login');
	    };
    }]);
