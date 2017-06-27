angular.module('myApp').controller('registerController',['$http', '$scope','$rootScope', '$state', function($http, $scope,$rootScope, $state) {
    // localStorage.clear();
    $scope.inputs = {};
    $rootScope.user = '';
    $rootScope.loggedIn = false;
    
    $scope.submit = function(inputs) {
        $http.post('/api/register', $scope.inputs)
        .then(
        	function(response) { 

                localStorage.setItem('name',response.data.name);
                $rootScope.name = localStorage['name'];
                $state.go('login');
            }, 
            function(response) {
            	
                $scope.errors = response.data;
                $state.go('register');
           	}
        ); 
    }
}]);