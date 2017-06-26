angular.module('myApp').controller('postController',
    ['$scope', '$http', '$state','$location', '$rootScope','$stateParams', function($scope, $http, $state, $location, $rootScope,$stateParams) {

    	$rootScope.user = localStorage['user'];
        $rootScope.id = localStorage['id'];
        $rootScope.loggedIn = localStorage['loggedIn'];

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
		} else if ($state.current.name =="my_posts") {

			$http.get('/api/posts/my_posts')
    		.then(
    			function(response) {
    			$scope.posts = response.data.posts;
    		})
		} else if ($state.current.name == 'edit_post') {

            var id = $stateParams.id;

            $http.get('/api/posts/' +id+ '/edit').then(function(response){

                $scope.post = response.data.post;
                $scope.categories = response.data.categories;
            });
        } else if ($state.current.name == 'spec_posts') {

            var id = $stateParams.id;

            $http.get('/api/categories/' +id+ '/posts').then(function(response){

                $scope.spec_posts = response.data.spec_posts;
                $scope.category = response.data.category;
                
            });

        }

	    $scope.addPost = function(inputs){
            
            $scope.inputs = inputs;
            if (inputs.category_id != undefined) {

	            $http.post('/api/addPost',$scope.inputs).then(function(response){

	             $scope.status = response.data.status;

	            });
        	} else {

        		 $scope.status = "Choose Post Category.";
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
        $scope.update = function(inputs){
            $scope.inputs = inputs;
            $http.put('/api/posts/' + $scope.inputs.id, $scope.inputs).then(function(response){
            	    
            	$scope.status = response.data.status;

           	});  
        }
        $scope.spec = function(inputs){
            
            $scope.inputs = inputs;
            $state.go('spec_posts', {id: $scope.inputs});

        }
}]);