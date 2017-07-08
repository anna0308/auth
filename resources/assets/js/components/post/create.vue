<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2"> 
                <div class="col-md-6">
                   
                   <div class="alert alert-success" v-if="status">
                        {{status}}
                    </div>
                    <form   v-show="has_cat"  accept-charset="UTF-8" @button.prevent="addPost">
                        
                        <div class="form-group ">
                            <label for="Title:">Title:</label>
                            <input v-model="title" class="form-control" placeholder="Enter Title" name="title" type="text" v-validate="'required'">
                             <span v-show="errors.has('title')" class="help is-danger" style="color:red">{{ errors.first('title') }}</span>
                            <label for="Title:">Text:</label>
                            <textarea  v-model="text" class="form-control" placeholder="Enter Text" name="text" rows="6" cols="80" v-validate="'required'"></textarea>
                            <span v-show="errors.has('text')" class="help is-danger" style="color:red">{{ errors.first('text') }}</span>
                            <label for="Category:">Category:</label>
                            <select  v-model="category_id" class="form-control"  name="category_id" v-validate="'required'">
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
                            <input class="btn btn-success" v-on:click="addPost" value="Add New">
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
            text:"",
            category_id:"",
            categories:"",
            status:"",
            has_cat:"",
            image:""
        }
         
    },
    created(){
        this.$http.get('/api/posts/create').then((response)=>{
            if(response.data.categories === undefined) {
                this.status = response.data.status;
                this.has_cat = false;
            } else {
                this.categories = response.data.categories; 
                this.has_cat = true;   
            }               
        });
    },
    methods:{
        imageChanged(e){
            if(e.target.files && e.target.files[0]) {
                this.image = e.target.files[0];
            }
        },
        addPost() {
            this.$validator.validateAll().then(()=>{
                var inputs={title:this.title,text:this.text, category_id:this.category_id ,image:this.image};
                var myData = new FormData();
                for(var i in inputs) {
                    myData.append(i, inputs[i]);
                };
                if((inputs.title && inputs.text && inputs.category_id)!=""){
                    this.$http.post('/api/addPost',myData).then((response)=>{
                        this.status=response.data.status;
                    })
                } 
            }) 
       }
    }
}
</script>