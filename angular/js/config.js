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
  .state('home',{
    url: '/home',
    templateUrl: 'views/home.html',
    controller: 'homeController'
  })
  .state('create_cat',{
    url: '/categories/create',
    templateUrl: 'views/category/create.html',
    controller: 'categoryController'
  })
  .state('my_categories', {
       url: "/categories/my_categories",
       templateUrl: "views/category/my_categories.html",
       controller: "categoryController"
  })
  .state('categories', {
       url: "/categories",
       templateUrl: "views/category/index.html",
       controller: "categoryController"
  })
  .state("edit_cat", {
        url: "/categories/:id/edit",
        params: {
            id: null
        },
        templateUrl : "views/category/edit.html",
        controller: 'categoryController'
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