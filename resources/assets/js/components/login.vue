<template>
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
               
                   <!--  <div class="alert alert-success" v-if="name">
                        {{name}} you are registered.
                    </div> -->
                    <form class="form-horizontal" role="form" >

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input v-model="email" type="email" class="form-control" >

                               <!--  @if ($errors->has('email')) -->
                                    <!-- <span class="help-block" v-if="errors.email"> -->
                                        <!-- <strong><!-- {{errors.email[0]}} --><!-- </strong> -->
                                    <!-- </span>  -->
                               <!-- @endif -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input v-model="password" type="password" class="form-control" >

                                <!-- @if ($errors->has('password')) -->
                                   <!--  <span class="help-block" v-if="errors.password">
                                        <strong><!-- {{errors.password[0]}} --><!-- </strong>
                                    </span>  -->
                                <!--@endif -->
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input v-model="input.check" > Remember Me
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" v-on:click="login">
                                    Login
                                </button>
                                
                                <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                                <a href="redirect"><img class="img" style="width: 200px" src="https://fb-s-a-a.akamaihd.net/h-ak-fbx/v/t39.2365-6/17639236_1785253958471956_282550797298827264_n.png?oh=6d4bcc6ce8ef0405bd98cc86bba37b0f&amp;oe=599CB1EA&amp;__gda__=1507467620_2b3f36feb724150802d113ee2729714a" width="400" alt=""></a> -->

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
            }
        },
        methods:{
            login:function()
            {
                let inputs={ email:this.email,password:this.password};
                this.$http.post('/api/login', inputs)
                .then(
                    function(response) { 
                        console.log(response.data)
                        // localStorage.setItem('id',response.data.user.id)
                        // localStorage.setItem('user',response.data.user.name);
                        // $rootScope.user = localStorage['user'];
                        // $rootScope.id = localStorage['id'];
                        // localStorage.setItem('loggedIn',true);
                        // $rootScope.loggedIn = localStorage['loggedIn'];
                            
                        // $state.go('home');
                        
                    }, 
                    function(response) {

                        // $scope.status = response.data.status;
                     
                    }
                ); 
            }
        }
        // mounted() {
        //     alert("hello");
        // }
    }
    
</script>
