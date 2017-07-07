<template>
	<div style='width: 600px;margin:0 auto;'>
 		<div class="alert alert-success" v-if="status">
                    {{status}}
                </div>
		<form accept-charset="UTF-8">
            <div class="form-group ">
                <label for="Title:">Category-title:</label>
                <input  v-model="title" class="form-control"  name="title" type="text" v-validate="'required'">
                <span v-show="errors.has('title')" class="help is-danger" style="color:red">{{ errors.first('title') }}</span>
            </div>
            <div class="form-group">
                <input  class="btn btn-success" v-on:click="update()" value="Update">
            </div>
        </form>
	</div>
		
</template>
<script>
export default {
	data(){
		return {
			title:"",
			status:"",
			inputs:""
		}
		 
	},
	created(){
		let id = this.$route.params.id;
        this.$http.get('/api/categories/' +id+ '/edit').then((response)=>{
            this.category = response.data.category;
            this.title=response.data.category.title;
        });
	},
	methods:{
		update(){

			let id = this.$route.params.id;
			let inputs={title:this.title};
            this.$http.put('/api/categories/' + id, inputs).then((response)=>{
                this.status = response.data.status;
                console.log(this.status)
            });
        }
	}
}
</script>