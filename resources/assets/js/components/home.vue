<template>
			
			<div class="nav-side-menu" style="width:200px" id="home">
                <div class="brand" style="margin-left:20px;font-size:22px"><strong>Menu</strong></div>
                <div class="menu-list">
                    <ul id="menu-content" >
                        
                        <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                           <router-link to=""><i class="fa fa-users fa-lg"></i> Users <span style="color:black;margin-left:10px"></span> <span class="arrow">{{count_user}}</span> </router-link>
                        </li>
                        <li data-toggle="collapse" data-target="#service" class="collapsed">
                          <router-link to=""><i class="fa fa-globe fa-lg"></i> Categories <span style="color:black;margin-left:10px"></span><span class="arrow">{{count_category}}</span> </router-link>
                        </li>  
                        <ul class="sub-menu collapse" id="service">
                          <li><router-link to="/categories/my_categories">My Categories</router-link></li>
                          <li><router-link to="/categories">All Categories</router-link></li> 
                        </ul>
                        <li data-toggle="collapse" data-target="#new" class="collapsed">
                           <router-link to=""><i class="fa fa-envelope"></i> Posts<span style="color:black;margin-left:10px"></span><span class="arrow">{{count_post}}</span> </router-link >
                        </li>
                        <ul class="sub-menu collapse" id="new">
                          <li><router-link to="/posts/my_posts">My Posts</router-link></li>
                          <li><router-link to="/posts">All Posts</router-link></li>
                        </ul>
                    </ul>
                </div>
            </div>
</template>
<script>
export default {
	data(){
		return {
			count_user:"",
	        count_category:"",
	        count_post:""
		}
		 
	},
	mounted(){
		this.$http.get('/api/home')
	        .then(
	            (response) =>{ 
	                sessionStorage.setItem('count_user',response.data.count_user);
	                this.count_user= sessionStorage.getItem('count_user');
	                sessionStorage.setItem('count_category',response.data.count_category);
	                this.count_category= sessionStorage.getItem('count_category');
	                sessionStorage.setItem('count_post',response.data.count_post);
	                this.count_post= sessionStorage.getItem('count_post');
	            }, 
	            
	        ); 
	}
}
</script>