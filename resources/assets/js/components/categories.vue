<template>
		<div>
			<router-link to="/categories/create" class="btn btn-success">Create Category</router-link>
			 <div class="alert alert-success" v-if="status">
                    {{status}}
                </div>
			<div  v-for="category in categories">
		    		<div  v-bind:id="category.id" style="width:800px;border:2px solid silver;overflow:hidden;margin:0 auto; ">
		    			<!-- <router-link style="text-decoration: none; color:black" v-on:click="spec"> -->
		    				<div style="width: 500px;float:left;padding-left:10px; ">
		    					Category-title:
			    				<span style="color:green;" >
			    				{{ category.title }}
			    				</span>
		    				</div>
		    			<!-- </router-link> -->
		    			 <div style="width:200px;float:right;">
			    			<router-link to="" class="btn btn-success" style="float:right;" v-if="user == category.parent_id" >Edit</router-link>
			    			<button class="btn btn-danger" style="float:right;margin-right:10px" v-if="user == category.parent_id"  v-on:click="del(category.id)" >Delete</button>
			    			
	    				</div> 
	    			</div>
			</div>
		</div>
</template>
<script>
export default {
	data(){
		return {

			categories:"",
			user:sessionStorage.getItem('user_id'),
			status:""
			
		}
		 
	},
	created(){
		this.$http.get('/api/categories').then((response)=>{
            this.categories = response.data.categories;
        });
		
	},
	methods:{
        del(id){
            this.$http.delete('/api/deleteCategory/' + id).then((response)=>{
                 
                document.getElementById(id).remove();
                this.status = response.data.status;
                
            }); 
        }
    }
}
</script>