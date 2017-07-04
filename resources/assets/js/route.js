import VueRouter from 'vue-router';
import Login from './components/login';
import Register from './components/register';
let routes = [

	{path: '/login', component: Login},
	{path:'/register', component: Register}

];
export default new VueRouter({
	routes
})
