angular.module('myApp').controller('registerController',['$http', '$scope','$rootScope', '$state', function($http, $scope,$rootScope, $state) {
    $scope.inputs = {};
    $scope.submit = function(inputs) {
        $http.post('/api/register', $scope.inputs)
        .then(
        	function(response) {  
                 	
                // localStorage.setItem('user',response.data.resource.name);
                $rootScope.user = response.data.name;
                // localStorage.setItem('loggedIn',true);
                // $rootScope.loggedIn = localStorage['loggedIn'];
                // console.log($rootScope.loggedIn);
                $state.go('home');
            }, 
            function(response) {

                $scope.errors = response.data;
                console.log($scope.errors);
           	}
        ); 
    }

}]);