<template>
			
			<div class="nav-side-menu" style="width:200px">
                <div class="brand" style="margin-left:20px;font-size:22px"><strong>Menu</strong></div>
                <div class="menu-list">
                    <ul id="menu-content" >
                        
                        <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                          <a href=""><i class="fa fa-users fa-lg"></i> Users <span style="color:black;margin-left:10px"></span> <span class="arrow">{{count_user}}</span></a>
                        </li>
                        <li data-toggle="collapse" data-target="#service" class="collapsed">
                          <a href=""><i class="fa fa-globe fa-lg"></i> Categories <span style="color:black;margin-left:10px"></span><span class="arrow">{{count_category}}</span></a>
                        </li>  
                        <ul class="sub-menu collapse" id="service">
                          <!-- <li><a ui-sref="my_categories">My Categories</a></li>
                          <li><a ui-sref="categories">All Categories</a></li> -->
                        </ul>
                        <li data-toggle="collapse" data-target="#new" class="collapsed">
                          <a href=""><i class="fa fa-envelope"></i> Posts<span style="color:black;margin-left:10px"></span><span class="arrow">{{count_post}}</span></a>
                        </li>
                        <ul class="sub-menu collapse" id="new">
                         <!--  <li><a ui-sref="my_posts">My Posts</a></li>
                          <li><a ui-sref="posts">All Posts</a></li> -->
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