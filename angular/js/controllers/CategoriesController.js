angular.module('myApp').controller('CategoriesController',
    ['$scope', '$http', '$state','$location', '$rootScope', '$stateParams',function($scope, $http, $state, $location, $rootScope,$stateParams) {
    	
        $rootScope.user = localStorage['user'];
        $rootScope.id = localStorage['id'];
        $rootScope.loggedIn = localStorage['loggedIn'];
        $rootScope.count_user=localStorage['count_user'];
        $rootScope.count_post=localStorage['count_post'];
        $rootScope.count_category=localStorage['count_category'];
        init();
        // initial function
        function init() {
            switch ($state.current.name) {

                case "my_categories"   : myCategories(); break;
                case "categories"      : categories(); break;
                case "edit_cat"        : editCat(); break;
                case "spec_posts"      : specPosts(); break;
            }
        }
        
        function myCategories() {
            $http.get('/api/categories/my_categories')
            .then(
                function(response) {
                $scope.categories = response.data.categories;
            })
        }

        function categories(){
            $http.get('/api/categories').then(function(response){
                $scope.categories = response.data.categories;
            });
        }

        function  editCat() {
            var id = $stateParams.id;
            $http.get('/api/categories/' +id+ '/edit').then(function(response){
                $scope.category = response.data.category;
            });
        }

        function specPosts() {
            var id = $stateParams.id;
            $http.get('/api/categories/' +id+ '/posts').then(function(response){
                $scope.spec_posts = response.data.spec_posts;
                $scope.category = response.data.category;
            });
        }
          
        $scope.addCategory = function(inputs){
            $scope.inputs = inputs;
            $http.post('/api/addCategory',$scope.inputs).then(function(response){
                $scope.status = response.data.status;
                document.getElementById('cat').value="";
            },function(response){
                $state.go('create_cat');
            });
        }

        $scope.delete = function(inputs){
            $scope.inputs = inputs;
            $http.delete('/api/deleteCategory/' + $scope.inputs).then(function(response){
                $scope.status = response.data.status;
                if($state.current.name == 'categories') {
                    categories();
                } else {
                    myCategories();
                }
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

        $scope.spec = function(inputs){
            $scope.inputs = inputs;
            $state.go('spec_posts', {id: $scope.inputs});
        }

}]);