angular.module('myApp').controller('registerController',['$http', '$scope','$rootScope', '$state', function($http, $scope,$rootScope, $state) {
    $scope.inputs = {};
    $rootScope.loggedIn = false;
    
    $scope.submit = function(inputs) {
        $http.post('/api/register', $scope.inputs)
        .then(
        	function(response) {  
                 
                localStorage.setItem('name',response.data.name);
                $rootScope.name = localStorage['name'];
                // localStorage.setItem('user',response.data.user.name);
                // $rootScope.user = localStorage['user'];
                // $rootScope.id = localStorage['id'];
                // localStorage.setItem('loggedIn',true);
                // $rootScope.loggedIn = localStorage['loggedIn'];
                
                $state.go('login');
            }, 
            function(response) {
            	
                $scope.errors = response.data;
           	}
        ); 
    }

}]);