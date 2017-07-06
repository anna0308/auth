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
			    			<button class="btn btn-success" style="float:right;" v-on:click="edit(category.id)" >Edit</button>
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
			edit_id:"",
		}
		 
	},
	created(){
		this.$http.get('/api/categories/my_categories')
    		.then((response)=> {
    			this.categories = response.data.categories;
    		})
		
	},
	methods:{
        del(id){
            this.$http.delete('/api/deleteCategory/' + id).then((response)=>{
                 
                document.getElementById(id).remove();
                this.status = response.data.status;
                
            }); 
        },
        edit(id)
        {
        	sessionStorage.setItem('edit_id', id);
            this.edit_id= sessionStorage.getItem('edit_id');
            window.location='http://laravel.dev/vue/#/categories/'+id+'/edit';
        }
    }
}
</script>