<template>
	<diV>
	<router-link  to="/posts/create" class="btn btn-success">Create Post</router-link>
		<!-- <div class="alert alert-success" v-if="status">
                    {{status}}
                </div>
		<div>
    		<div id = "{{ post.id }}"  style="width: 600px;border:2px solid silver;margin:0 auto;overflow:hidden;" ng-repeat="post in posts">
	    			<div class="media">
		      			<a class="pull-left" href="#">
		      	
		    					<img ng-show="post.image == null" class="media-object" style="width:200px" src="../images/logo.jpg">
		    				
		    				<img ng-show="post.image" class="media-object" style="width:200px" src="../images/{{post.image}}">
		 		
		  				</a>
		  				<div class="media-body">
		    			<h4 class="media-heading" style="color:green"><span style="color:black">Title:</span>  {{post.title}}</h4>
		          		<p>{{post.text}}</p>
		       			</div>
		     		</div> 
		     		
		    			<a class="btn btn-success" style="float:right;" ng-click="edit(post.id)">Edit</a>
		    			<form accept-charset="UTF-8">
	                    	<input type="hidden" name="_method" value="DELETE">
		    				<button type="submit" class="btn btn-danger" style="float:right;" ng-click="delete(post.id)" >Delete</button>
		    			</form> 
	    			
    			</div>
  		
		</div> -->
	</diV>
</template>
<script>
export default {
	data(){
		return {
			
		}
		 
	},
	created(){
		
		
	},
	methods:{
       
    }
}

</script>