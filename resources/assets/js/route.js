import VueRouter from 'vue-router';
import Login from './components/login';
import Register from './components/register';
import Home from './components/home';



let routes = [

	{path: '/login', component: Login},
	{path:'/register', component: Register},
	{path:'/home', component:Home}
];
export default new VueRouter({
	routes
})
