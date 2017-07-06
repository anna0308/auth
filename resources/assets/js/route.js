import VueRouter from 'vue-router';
import Login from './components/login';
import Register from './components/register';
import Home from './components/home';
import MyCategories from './components/my_categories';
import Categories from './components/categories';
import Create_cat from './components/create_cat';
import Edit_cat from './components/edit_cat'

let routes = [

	{path: '/login', component: Login},
	{path:'/register', component: Register},
	{path:'/home', component:Home},
	{path:'/categories/my_categories',component:MyCategories},
	{path:'/categories',component:Categories},
	{path:'/categories/create',component:Create_cat},
	{path:'/categories/:id/edit', component:Edit_cat}
];
export default new VueRouter({
	routes
})
