angular.module('myApp').controller('PostsController',
    ['$scope', '$http', '$state','$location', '$rootScope','$stateParams','Upload', function($scope, $http, $state, $location, $rootScope,$stateParams, Upload) {

    	
        init();

        // initial function
        function init() {
           
            switch ($state.current.name) {
                case "posts"   : posts(); break;
                case "create_post"      : createPost(); break;
                case "my_posts"        : myPosts(); break;
                case "edit_post"      : editPost(); break;
            }
            
        }
        function posts() {
            $http.get('/api/posts').then(function(response){
                $scope.user_posts = response.data.user_posts;
                $scope.other_posts = response.data.other_posts;
            })  
        }

        function myPosts() {
            $http.get('/api/posts/my_posts')
            .then(
                function(response) {
                $scope.posts = response.data.posts;
            })
        }
        function createPost() {
            $http.get('/api/posts/create').then(function(response){
                if(response.data.categories === undefined) {
                    $scope.status = response.data.status;
                    $scope.has_cat = false;
                } else {
                    $scope.categories = response.data.categories; 
                    $scope.has_cat = true;   
                }
            });
        }

        function editPost() {
            var id = $stateParams.id;
            $http.get('/api/posts/' +id+ '/edit').then(function(response){
                $scope.post = response.data.post;
                $scope.categories = response.data.categories;
            });
        }
    	 
	    $scope.addPost = function(inputs, file){

            $scope.inputs = inputs;
            if(file != undefined) {
              $scope.inputs.image = file;
              file.upload = Upload.upload({
                    url: '/api/addPost',
                    data: $scope.inputs,
                });
                file.upload.then(function (response) 
                {
                    $scope.status = response.data.status;
                });
            } else {
              $http.post('/api/addPost',$scope.inputs).then(function(response){
                $scope.status = response.data.status;
              }); 
            }
        }

        $scope.delete = function(inputs){
            $scope.inputs = inputs;
            $http.delete('/api/deletePost/' + $scope.inputs).then(function(response){
                $scope.status = response.data.status;
                if($state.current.name == 'posts') {
                    posts();
                } else {
                    myPosts();
                }
            }); 
            
        }

        $scope.edit = function(inputs){
            $scope.inputs = inputs;
            $state.go('edit_post', {id: $scope.inputs});
        }

        $scope.update = function(inputs,file){
            $scope.inputs = inputs;
            if(file != undefined) {
                $scope.inputs.image = file;
                file.upload = Upload.upload({
                    url: '/api/posts/' + $scope.inputs.id,
                    data: $scope.inputs,
                });
                file.upload.then(function (response) 
                {
                    $scope.status = response.data.status;
                });

            } else {

              $http.post('/api/posts/' + $scope.inputs.id, $scope.inputs).then(function(response){  
                $scope.status = response.data.status;
                });  
            }
            
        }

        
}]);
