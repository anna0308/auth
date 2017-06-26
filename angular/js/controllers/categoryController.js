angular.module('myApp').controller('categoryController',
    ['$scope', '$http', '$state','$location', '$rootScope', '$stateParams',function($scope, $http, $state, $location, $rootScope,$stateParams) {
    	
        $rootScope.user = localStorage['user'];
        $rootScope.id = localStorage['id'];
        $rootScope.loggedIn = localStorage['loggedIn'];

    	if($state.current.name == "my_categories") {

    		$http.get('/api/categories/my_categories')
    		.then(
    			function(response) {
    			$scope.categories = response.data.categories;
    		})
    	}

        else if($state.current.name == 'categories') {
            
            $http.get('/api/categories').then(function(response){

                $scope.categories = response.data.categories;

            });
        }
        else if ($state.current.name == 'edit_cat') {

            var id = $stateParams.id;

            $http.get('/api/categories/' +id+ '/edit').then(function(response){
                $scope.category = response.data.category;

            });
        }
        // else if ($state.current.name == 'postByCategory') {
        //     var id = $state.params.id;
        //     console.log(id);
        //     $http.get('/api/postByCategory/' + id).then(function(response){
        //     $scope.posts = response.data.posts;
        //     });
        // }
       
        $scope.addCategory = function(inputs){
            
            $scope.inputs = inputs;
            $http.post('/api/addCategory',$scope.inputs).then(function(response){

                $scope.status = response.data.status;
                document.getElementById('cat').value="";
            },
            function(response){

                $state.go('create_cat');
            });
        }
        $scope.delete = function(inputs){

            $scope.inputs = inputs;
            $http.delete('/api/deleteCategory/' + $scope.inputs).then(function(response){

                document.getElementById($scope.inputs).remove();
                $scope.status = response.data.status;
                
            }); 
            
        }
        $scope.edit = function(inputs){
            $scope.inputs = inputs;
            $state.go('edit_cat', {id: $scope.inputs});
        }
        $scope.update = function(inputs){
            $scope.inputs = inputs;
            $http.put('/api/categories/' + $scope.inputs.id, $scope.inputs).then(function(response){
                $scope.status = response.data.status;
                console.log($scope.status);
            }); 
        }
    }]);