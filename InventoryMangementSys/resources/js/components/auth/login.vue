<template>
    <div themebg-pattern="theme1" id="divLogin">        
        <section class="login-block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <form class="md-float-material form-material" @submit.prevent="login">
                            <div class="text-center">
                                <img src="backend/files/assets/images/logo.png" alt="logo.png">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center txt-primary">Sign In</h3>
                                        </div>
                                    </div>
                                    <!-- <div class="row m-b-20">
                                        <div class="col-md-6">
                                            <button class="btn btn-facebook m-b-20 btn-block"><i class="icofont icofont-social-facebook"></i>facebook</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-twitter m-b-20 btn-block"><i class="icofont icofont-social-twitter"></i>twitter</button>
                                        </div>
                                    </div> -->
                                    <!-- <p class="text-muted text-center p-b-5">Sign in with your regular account</p> -->
                                    <div class="form-group form-primary">
                                        <input type="email" class="form-control" v-model="form.email">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Username</label>
                                        <small class="text-danger" v-if="errors.email">*{{ errors.email[0] }} </small>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="password"  class="form-control" v-model="form.password">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Password</label>
                                        <small class="text-danger" v-if="errors.password">*{{ errors.password[0] }} </small>
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="forgot-phone text-right float-right">
                                                <router-link to="/forgetpassword" class="text-right f-w-600">Forgot Password?</router-link>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                                            
                                        </div>
                                    </div>
                                    <p class="text-inverse text-left">Don't have an account?<router-link to="/register"><b>Register here </b></router-link> for free!</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default { 
    created(){
        if(User.loggedIn()){
            this.$router.push({ name: 'home' })
        }
    },   
    data(){
        return {
            form: {
                email: null,
                password: null
            },
            errors:{}
        }
    },
    methods: {
        login(){
           axios.post('/api/auth/login', this.form)
           .then(res =>{
               User.responseAfterLogin(res)
               Toast.fire({
                    icon: 'success',
                    title: 'Signed in successfully'
                })
               this.$router.push({ name: 'home' })
           })
        //    .catch(
        //        Toast.fire({
        //             icon: 'warning',
        //             title: 'Invalid Email or Password!'
        //         })
        //    )
           .catch(error =>{
                this.errors = error.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: 'Invalid Email or Password!'
                })
           })
        }
    }
}    
</script>

<style scoped>
#divLogin{
    margin-left: -250px;
    margin-top: -60px;
    
}
@media only screen and (max-width: 600px) {
    #divLogin{
        margin-left: 0px;
        margin-top: -60px;
    }
}
</style>