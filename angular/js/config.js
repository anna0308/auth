angular.module("myApp").config(function($stateProvider, $urlRouterProvider) {
  // 
  // For any unmatched url, redirect to /state1 
  // 
  // Now set up the states     
  $stateProvider
  .state('login',{
    url: '/',
    templateUrl: 'views/login.html',
    controller: 'LoginController',
    data :
    {
      guest: true
    }
  })
  .state('register',{
    url: '/register',
    templateUrl: 'views/register.html',
    controller: 'RegisterController',
    data :
    {
      guest: true
    }
  }) 
  .state('home',{
    url: '/home',
    templateUrl: 'views/home.html',
    controller: 'HomeController',
    data :
    {
      guest: false
    }
  })
  .state('create_cat',{
    url: '/categories/create',
    templateUrl: 'views/category/create.html',
    controller: 'CategoriesController',
    data :
    {
      guest: false
    }
  })
  .state('my_categories', {
      url: "/categories/my_categories",
      templateUrl: "views/category/my_categories.html",
      controller: "CategoriesController",
      data :
      {
        guest: false
      }
  })
  .state('categories', {
      url: "/categories",
      templateUrl: "views/category/index.html",
      controller: "CategoriesController",
      data :
      {
        guest: false
      }
  })
  .state("edit_cat", {
      url: "/categories/:id/edit",
      params: {
          id: null
      },
      data :
      {
        guest: false
      },
      templateUrl : "views/category/edit.html",
      controller: 'CategoriesController'
  })
  .state("update", {
      url: "/categories/:id",
      templateUrl : "views/category/edit.html",
      controller: 'CategoriesController',
      data :
      {
        guest: false
      }
  })
  .state('posts', {
      url: "/posts",
      templateUrl: "views/post/index.html",
      controller: "PostsController",
      data :
      {
        guest: false
      }
  })
  .state('my_posts', {
      url: "/posts/my_posts",
      templateUrl: "views/post/my_posts.html",
      controller: "PostsController",
      data :
      {
        guest: false
      }
  })
  .state('create_post', {
      url: "/posts/create",
      templateUrl: "views/post/create.html",
      controller: "PostsController",
      data :
      {
        guest: false
      }

  })
  .state("edit_post", {
        url: "/posts/:id/edit",
        params: {
            id: null
        },
        data :
        {
          guest: false
        },
        templateUrl : "views/post/edit.html",
        controller: 'PostsController'
  })
  .state("spec_posts", {
        url: "/categories/:id/posts",
        params: {
            id: null
        },
        data :
        {
          guest: false
        },
        templateUrl : "views/post/specified.html",
        controller: 'CategoriesController'
  })
  $urlRouterProvider.otherwise("/");
});