<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" @button.prevent="register">

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input v-model="name" v-validate="'required|max:50'"  name="name" type="text" class="form-control" >
                                    <span v-show="errors.has('name')" class="help is-danger" style="color:red">{{ errors.first('name') }}</span>
                                </div>
                            </div>

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
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input v-model="password_confirmation" name="password-confirm" type="password" class="form-control" v-validate="'required|confirmed:password'">
                                    <span v-show="errors.has('password-confirm')" class="help is-danger" style="color:red">{{ errors.first('password-confirm') }}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <input class="btn btn-primary" v-on:click="register" value="Register">
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
                name:"",
                email:"",
                password:"",
                password_confirmation:"",
                inputs:"",
            }
        },
        methods:{
            register()
            {
                this.$validator.validateAll().then(()=>{
                    let inputs = { 

                        name:this.name,
                        email:this.email,
                        password:this.password,
                        password_confirmation:this.password_confirmation

                    };
                    if((inputs.name && inputs.email && inputs.password && inputs.password_confirmation)  != "" && inputs.password===inputs.password_confirmation) {
                        this.$http.post('/api/register', inputs)
                        .then(
                            function(response) { 
                                // localStorage.setItem('name',response.data.name);
                                // $rootScope.name = localStorage['name'];
                                // $state.go('login');
                            }
                        ); 
                    }
                })
                
            },
             getToken(){
               return document.querySelector('#token').getAttribute('content');
           }
        }
        // mounted() {
        //     alert("hello");
        // }
    }
    
</script>
