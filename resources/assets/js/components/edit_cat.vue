<template>
	<!-- <div style='width: 600px;margin:0 auto;'>
 		<div class="alert alert-success" v-if="status">
                    {{status}}
                </div>
 			<form accept-charset="UTF-8">
                    <div class="form-group ">
                        <label for="Title:">Category-title:</label>
                        <input v-model="category.title" class="form-control"  name="title" type="text">
                        <input class="form-control" placeholder="Enter Title" name="title" type="text"  v-model="title" v-validate="'required'">
                        <span v-show="errors.has('title')" class="help is-danger" style="color:red">{{ errors.first('title') }}</span>
                    </div>
                    <div class="form-group">
                        <button  class="btn btn-success" >Update</button>
                    </div>
            </form>
		</div> -->
		
</template>
<script>
export default {
	data(){
		return {
			
		}
		 
	},
	mounted(){
	
		alert($route.params.id)
	}
}
</script>