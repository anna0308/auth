<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2"> 
                <div class="col-md-6">
                   
                   <div class="alert alert-success" v-if="status">
                        {{status}}
                    </div>
                    <form  accept-charset="UTF-8" @button.prevent="update">
                        
                        <div class="form-group ">
                            <label for="Title:">Title:</label>
                            <input v-model="post.title" class="form-control"  name="title" type="text" v-validate="'required'">
                             <span v-show="errors.has('title')" class="help is-danger" style="color:red">{{ errors.first('title') }}</span>
                            <label for="Title:">Text:</label>
                            <textarea  v-model="post.text" class="form-control" name="text" rows="6" cols="80" v-validate="'required'"></textarea>
                            <span v-show="errors.has('text')" class="help is-danger" style="color:red">{{ errors.first('text') }}</span>
                            <label for="Category:">Category:</label>
                            <select  v-model="post.category_id" class="form-control"  name="category_id" v-validate="'required'">
                                    <option  v-for="category in categories" v-bind:value="category.id" >{{category.title}}
                                    </option>
                            </select>
                            <span v-show="errors.has('category_id')" class="help is-danger" style="color:red">{{ errors.first('category_id') }}</span>
                            <span class="text-danger"></span>
                             <label for="Category:">Image:</label>
                             <span id="fileselector">
                                <label class="btn btn-default form-control" for="upload-file-selector">
                                    <input vf-select type="file" name="file"    
                                 v-on:change="imageChanged"/>
                                    <i class="fa_icon icon-upload-alt margin-correction"></i>
                                </label> 
                                
                            </span> 
                        </div>
                        <div class="form-group">
                            <input class="btn btn-success" v-on:click="update" value="Update">
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
            post:"",
            categories:"",
            status:"",
            image:""
        }   
    },
    created(){
        let id = this.$route.params.id;
        this.$http.get('/api/posts/' +id+ '/edit').then((response)=>{

            this.post = response.data.post;
            this.categories = response.data.categories;
        });
    },
    methods:{
        imageChanged(e){
            if(e.target.files && e.target.files[0]) {
                this.image = e.target.files[0];
            }
        },
        update(){
            let id = this.$route.params.id;
            this.$validator.validateAll().then(()=>{
                var inputs={title:this.post.title,text:this.post.text, category_id:this.post.category_id ,image:this.image};
                var myData = new FormData();
                for(var i in inputs) {
                    myData.append(i, inputs[i]);
                };
                if((inputs.title && inputs.text && inputs.category_id)!=""){
                    this.$http.post('/api/posts/' + id, myData).then((response)=>{
                        this.status = response.data.status;
                    });  
                } 
            })  
        }
    }
}
</script>