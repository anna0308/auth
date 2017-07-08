<template>
	<div>
			<router-link to="/categories/create" class="btn btn-success">Create Category</router-link>
			<div class="alert alert-success" v-if="status">
                {{status}}
            </div>
			<div  v-for="category in categories">
	    		<div  v-bind:id="category.id" style="width:800px;border:2px solid silver;overflow:hidden;margin:0 auto; ">
	    			<router-link :to="{path: '/categories/' + category.id+'/posts'}" style="text-decoration: none; color:black" >
	    				<div style="width: 500px;float:left;padding-left:10px; ">
	    					Category-title:
		    				<span style="color:green;" >
		    				{{ category.title }}
		    				</span>
	    				</div>
	    			</router-link>
	    			 <div style="width:200px;float:right;">
		    			<router-link :to="{path: '/categories/' + category.id+'/edit'}" class="btn btn-success" style="float:right;"  >Edit</router-link>
		    			<button class="btn btn-danger" style="float:right;margin-right:10px" v-on:click="del(category.id)" >Delete</button>
		    			
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
			status:"",
		}
	},
	created(){
		this.init();
	},
	methods:{
		init(){
			this.$http.get('/api/categories/my_categories')
    		.then((response)=> {
    			this.categories = response.data.categories;
    		})	
		},
        del(id){
            this.$http.delete('/api/deleteCategory/' + id).then((response)=>{
                 
                this.init();
                this.status = response.data.status;
                
            }); 
        },

    }
}
</script>