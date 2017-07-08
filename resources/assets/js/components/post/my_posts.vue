<template>
	<diV>
		<router-link  to="/posts/create" class="btn btn-success">Create Post</router-link>
		<div class="alert alert-success" v-if="status">
            {{status}}
        </div>
		<div>
    		<div :id = "post.id"  style="width: 600px;border:2px solid silver;margin:0 auto;overflow:hidden;" v-for="post in posts">
    			<div class="media">
	      			<a class="pull-left" href="#">
	      	
	    				<img v-show="post.image == null" class="media-object" style="width:200px" :src="'../images/logo.jpg'">
	    				
	    				<img v-show="post.image" class="media-object" style="width:200px" :src="`../images/${post.image}`">
	 		
	  				</a>
	  				<div class="media-body">
		    			<h4 class="media-heading" style="color:green"><span style="color:black">Title:</span>  {{post.title}}</h4>
		          		<p>{{post.text}}</p>
	       			</div>
	     		</div> 
     			<router-link :to="{path: '/posts/' + post.id+'/edit'}" class="btn btn-success" style="float:right;" >Edit</router-link>
     			<button class="btn btn-danger" style="float:right;margin-right:10px" v-on:click="del(post.id)" >Delete</button>
    		</div>
  		
		</div>
	</diV>
</template>
<script>
export default {
	data(){
		return {
			posts:"",
			status:""
		}
		 
	},
	created(){
		
		this.init();
	},
	methods:{
		init() {
			this.$http.get('/api/posts/my_posts')
    		.then((response)=> {
    			this.posts = response.data.posts;
    			console.log(this.posts)
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