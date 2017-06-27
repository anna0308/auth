angular.module('myApp').controller('postController',
    ['$scope', '$http', '$state','$location', '$rootScope','$stateParams','Upload', function($scope, $http, $state, $location, $rootScope,$stateParams, Upload) {

    	$rootScope.user = localStorage['user'];
        $rootScope.id = localStorage['id'];
        $rootScope.loggedIn = localStorage['loggedIn'];
        $rootScope.count_user=localStorage['count_user'];
        $rootScope.count_post=localStorage['count_post'];
        $rootScope.count_category=localStorage['count_category'];

    	if($state.current.name == 'posts')
	    {
	        $http.get('/api/posts').then(function(response){
	        	
			  	$scope.user_posts = response.data.user_posts;
			  	$scope.other_posts = response.data.other_posts;

	    	})  
	    } else if($state.current.name =="create_post") {
		    	$http.get('/api/posts/create').then(function(response){

		        	if(response.data.categories === undefined) {

		        		$scope.status = response.data.status;
		        		$scope.has_cat = false;

		        	} else {

		        		$scope.categories = response.data.categories; 
		        		$scope.has_cat = true;   
		        	}
				  	   	
		    	});
		} else if($state.current.name =="my_posts") {

			$http.get('/api/posts/my_posts')
    		.then(
    			function(response) {
    			$scope.posts = response.data.posts;
    		})
		} else if($state.current.name == 'edit_post') {

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
            console.log(inputs);
            $http.delete('/api/deletePost/' + $scope.inputs).then(function(response){

                document.getElementById($scope.inputs).remove();
                $scope.status = response.data.status;

                
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
