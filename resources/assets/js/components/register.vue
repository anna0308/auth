<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input v-model="name"  id="name" type="text" class="form-control" >

                                    <!-- @if ($errors->has('name'))-->
                                        <!-- <span class="help-block" ng-if="errors.name">
                                            <strong style="color:red">{{ errors.name[0] }}</strong>
                                        </span> -->
                                    <!-- @endif -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input v-model="email" id="email" type="email" class="form-control" >

                                    <!-- @if ($errors->has('email')) -->
                                        <!-- <span class="help-block" ng-if="errors.email">
                                            <strong style="color:red">{{ errors.email[0] }}</strong>
                                        </span> -->
                                    <!--@endif -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input v-model="password" id="password" type="password" class="form-control">

                                    <!-- @if ($errors->has('password'))-->
                                       <!--  <span class="help-block" ng-if='errors.password'>
                                            <strong  style="color:red">{{ errors.password[0] }}</strong>
                                        </span> -->
                                    <!--@endif -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input v-model="password_confirmation" id="password-confirm" type="password" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" v-on:click="register">
                                        Register
                                    </button>
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
            register:function()
            {
                let inputs = { 

                    name:this.name,
                    email:this.email,
                    password:this.password,
                    password_confirmation:this.password_confirmation
                };
                this.$http.post('/api/register', inputs)
                .then(
                    function(response) { 
                        console.log(responce.data);
                        // localStorage.setItem('name',response.data.name);
                        // $rootScope.name = localStorage['name'];
                        // $state.go('login');
                    }, 
                    function(response) {
                        
                        // $scope.errors = response.data;
                        // $state.go('register');
                    }
                ); 
                    }
        }
        // mounted() {
        //     alert("hello");
        // }
    }
    
</script>
