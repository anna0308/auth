<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2"> 
                <div class="col-md-6">
                    <h3>Add New Category</h3>
                    <div class="alert alert-success" v-if="status">
                        {{status}}
                    </div>
                    <form role="form"  @submit.prevent="addCategory">
                        <div class="form-group ">
                            <label for="Title:">Category-title:</label>
                            <input class="form-control" placeholder="Enter Title" name="title" type="text"  v-model="title" v-validate="'required'">
                            <span v-show="errors.has('title')" class="help is-danger" style="color:red">{{ errors.first('title') }}</span>
                               
                            <span class="text-danger"></span>
                        </div> 
                        <div class="form-group">
                            <input class="btn btn-success" v-on:click="addCategory" value="Add New">
                            
                        </div>
                    </form> 
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
 export default {
    data(){
        return {
            title:"",
            user:sessionStorage.getItem('user_id'),
            status:""
        }    
    },
     methods:{
            addCategory()
            {
                this.$validator.validateAll().then(()=>{
                let inputs={title:this.title};
                if(inputs.title!="") {
                    this.$http.post('/api/addCategory',inputs).then((response)=>{
                        this.status = response.data.status;
                        this.title="";
                    }) 
                }
            })
    }
}
}
</script>