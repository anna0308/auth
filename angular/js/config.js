angular.module("myApp").config(function($stateProvider, $urlRouterProvider) {
  // 
  // For any unmatched url, redirect to /state1 
  // 
  // Now set up the states     
  $stateProvider
   .state('login',{
    url: '/',
    templateUrl: 'views/login.html',
    controller: 'loginController'
  })
  .state('register',{
    url: '/register',
    templateUrl: 'views/register.html',
    controller: 'registerController'
  }) 
  // .state('posts', {
  //     url: "/posts",
  //     templateUrl: "views/posts.html",
  //     controller: "postController"
  // })
  // .state('my_posts', {
  //     url: "/my_posts",
  //     templateUrl: "views/my_posts.html",
  //     controller: "postController"
  // })
  // .state('posts_create', {
  //     url: "/posts/create",
  //     templateUrl: "views/create.html",
  //   controller: "postController"
  // })
  // .state('post_edit', {
  //     url: "/posts/:id/edit",
  //     templateUrl: "views/edit.html",
  //   controller: "postController"
  // })
  // .state('show', {
  //     url: "/posts/:id",
  //     templateUrl: "views/show.html",
  //     controller: "postController"
  // })
 
  

    $urlRouterProvider.otherwise("/");
});