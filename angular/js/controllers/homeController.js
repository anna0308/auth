angular.module('myApp').controller('homeController',
    ['$scope', '$http', '$state','$location', '$rootScope', function($scope, $http, $state, $location, $rootScope) {
    	
    	$rootScope.loggedIn = true;

    	if($state.current.name == "home"){
    		
    		$http.get('/api/home')
    		.then(
	        	function(response) { 
	      
	            localStorage.setItem('count_user',response.data.count_user);
	            $rootScope.count_user=localStorage['count_user'];
	            localStorage.setItem('count_post',response.data.count_post);
	            $rootScope.count_post=localStorage['count_post'];
	            localStorage.setItem('count_category',response.data.count_category);
	           	$rootScope.count_category=localStorage['count_category'];
		            
	            }, 
	            
	        ); 
    	}


    }]);