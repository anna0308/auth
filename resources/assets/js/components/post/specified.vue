<template>
	<div class="container">
		<h2 style="color:blue"><span style="color:black">Category:</span>{{category.title}}</h2>
	  	<div class="well">
	  		
			<h1 v-if="!spec_posts[0]">There are no posts... </h1>
		
			<div  v-for="spec_post in spec_posts" style="width: 600px;border:2px solid silver;margin:0 auto;overflow:hidden;">
    			<div class="media">
	      			 
	    				
    				<img v-show="spec_post.image == null" class="media-object" style="width:200px" :src="'../images/logo.jpg'">
    				
    				<img v-show="spec_post.image" class="media-object" style="width:200px" :src="`../images/${spec_post.image}`">
	  				
	  				<div class="media-body">
	    			<h4 class="media-heading" style="color:green"><span style="color:black">Title:</span>  {{spec_post.title}}</h4>
	          		<p>{{spec_post.text}}</p>
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
			spec_posts:"",
			category:""
		}
	},
	created(){
			var id = this.$route.params.id;
            this.$http.get('/api/categories/' +id+ '/posts').then((response)=>{
                this.spec_posts = response.data.spec_posts;
                this.category = response.data.category;
            });
	}
	
}
</script>