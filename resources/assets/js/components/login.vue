<template>
    <div class="container" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <div class="alert alert-success" v-if="status">
                        {{status}}.
                    </div> 
                    <form class="form-horizontal"  @submit.prevent="login">

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input v-model="email" v-validate="'required|email'" name="email" type="text" class="form-control">
                                <span v-show="errors.has('email')" class="help is-danger" style="color:red">{{ errors.first('email') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input v-model="password" name="password" type="password" class="form-control" v-validate="'required|min:6'" />
                                <span v-show="errors.has('password')" class="help is-danger" style="color:red">{{ errors.first('password') }}</span>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <input class="btn btn-primary" v-on:click="login" value="Login" >
                            </div>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {

        data() {
            return {
                email:"",
                password:"",
                inputs:"",
                status:"",
                user:""
            }
        },
        methods:{
            login()
            {
                this.$validator.validateAll().then(()=>{

                    let inputs={ email:this.email,password:this.password};

                    if((inputs.email && inputs.password) != "") {

                            this.$http.post('/api/login', inputs)
                            .then(
                                (response) =>{
                              
                                    if(response.data.user) {
                                        sessionStorage.setItem('user_id',response.data.user.id);
                                        this.user= sessionStorage.getItem('user_id');
                                        this.$router.push('/home');
                                    }  else {
                                        sessionStorage.setItem('status', response.data.status);
                                        this.status= sessionStorage.getItem('status'); 
                                    }
                                }
                            ); 
                        }
                })
                 
            },
            getToken(){
               return document.querySelector('#token').getAttribute('content');
           }
        },
        
    }
    
</script>
