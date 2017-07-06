var app=angular.module('myApp',  ["ui.router","ngFileUpload"]);
app.run(['$rootScope', '$state', function($rootScope, $state){
    $rootScope.$on('$stateChangeStart', function(e, toState, toParams, fromState) {
    	if($rootScope.loggedIn && toState.data.guest) {
    		e.preventDefault();
    		$state.go('home', {}, {reload: true});
    		return false;
    	} //else if(!toState.data.guest) {
    	// 	e.preventDefault();
    	// 	$state.go('login', {}, {reload: true});
    	// 	return false;
    	// }

    });
}])
