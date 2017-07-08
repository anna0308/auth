import VueRouter from 'vue-router';
import Login from './components/login';
import Register from './components/register';
import Home from './components/home';
import MyCategories from './components/category/my_categories';
import Categories from './components/category/categories';
import Create_cat from './components/category/create';
import Edit_cat from './components/category/edit';
import MyPosts from './components/post/my_posts';
import Posts from './components/post/posts';
import Create_post from './components/post/create';
import Edit_post from './components/post/edit';
import Spec_posts from './components/post/specified'

let routes = [

	{path: '/login', component: Login},
	{path:'/register', component: Register},
	{path:'/home', component:Home},
	{path:'/categories/my_categories',component:MyCategories},
	{path:'/categories',component:Categories},
	{path:'/categories/create',component:Create_cat},
	{path:'/categories/:id/edit', component:Edit_cat},
	{path:'/posts/my_posts',component:MyPosts},
	{path:'/posts',component:Posts},
	{path:'/posts/create',component:Create_post},
	{path:'/posts/:id/edit', component:Edit_post},
	{path:'/categories/:id/posts', component:Spec_posts},
];
export default new VueRouter({
	routes
})
