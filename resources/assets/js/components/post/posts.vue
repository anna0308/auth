<template>
	<div>
		<router-link  to="/posts/create" class="btn btn-success">Create Post</router-link>
		<div class="alert alert-success" v-if="status">
                    {{status}}
                </div>
		<div>
    		<div  style="width: 600px;border:2px solid silver;margin:0 auto;overflow:hidden;" v-for="user_post in user_posts" :id="user_post.id">
	    			<div class="media">
		      			<a class="pull-left" href="#">
		    				<img v-show="user_post.image == null" class="media-object" style="width:200px" :src="'../images/logo.jpg'">
		    				<img v-show="user_post.image" class="media-object" style="width:200px" :src="`../images/${user_post.image}`">
		  				</a>
		  				<div class="media-body">
		    			<h4 class="media-heading" style="color:green"><span style="color:black">Title:</span>  {{user_post.title}}</h4>
		          		<p>{{user_post.text}}</p>
		       			</div>
		     		</div> 
		     		<router-link :to="{path: '/posts/' + user_post.id+'/edit'}" class="btn btn-success" style="float:right;" >Edit</router-link>
		     		<button class="btn btn-danger" style="float:right;margin-right:10px" v-on:click="del(user_post.id)" >Delete</button>
    			</div>
    			<div style="width: 600px;border:2px solid silver;margin:0 auto;overflow:hidden;" v-for="other_post in other_posts">
	    			<div class="media">
	    				<a class="pull-left" href="#">
		      			
		    				<img v-show="other_post.image == null" class="media-object" style="width:200px" :src="'../images/logo.jpg'">
		    				
		    				<img v-show="other_post.image" class="media-object" style="width:200px" :src="`../images/${other_post.image}`">
		 				
		 				</a>
		  				<div class="media-body">
		    			<h4 class="media-heading" style="color:green"><span style="color:black">Title:</span>  {{other_post.title}}</h4>
		          		<p>{{other_post.text}}</p>
		       			</div>
		     		</div> 
		     	</div>
  			
		</div> 
		
	</div>
</template>
<script>
export default {
	data(){
		return {
			status:"",
			user_posts:"",
			other_posts:""
		}
		 
	},
	created(){
		this.init();
	},
	methods:{
		init(){
			this.$http.get('/api/posts').then((response)=>{
			  	this.user_posts = response.data.user_posts;
			  	this.other_posts = response.data.other_posts;
	    	})  
		},
       del(id){
            this.$http.delete('/api/deletePost/' + id).then((response)=>{
                this.init();
                this.status = response.data.status;
            }); 
        }
    }
}

</script>