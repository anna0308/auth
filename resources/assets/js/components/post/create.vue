<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2"> 
                <div class="col-md-6">
                   
                   <div class="alert alert-success" v-if="status">
                        {{status}}
                    </div>
                    <form   v-show="has_cat" enctype="multipart/form-data" accept-charset="UTF-8" @button.prevent="addPost">
                        
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
            var myData = new FormData();
            myData.append("file", e.target.files[0]);
            myData.append("title", this.title);
            myData.append("text", this.title);
            myData.append("category_id", this.category_id);
            this.image=myData;
            console.log(myData);
        },
        addPost() {
            this.$validator.validateAll().then(()=>{

                var image =this.image ;
                var inputs={title:this.title,text:this.text, category_id:this.category_id};
                if((this.image && inputs.title && inputs.text && inputs.category_id)!=""){
                    // this.$http.post('/api/addPost',inputs).then((response)=>{
                    // console.log(response);
                    // })
                    // this.$http.post('/api/addPost',image).then(function(response){
                    //     console.log(response);
                    //     })
                    

                } else if(this.image="" && (inputs.title && inputs.text && inputs.category_id)!=""){
                    this.$http.post('/api/addPost',inputs).then(function(response){
                    console.log(response);
                    })
                }
            })  
       }
    }
}
</script>