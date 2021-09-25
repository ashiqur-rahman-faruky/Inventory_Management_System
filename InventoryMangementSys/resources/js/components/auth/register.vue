<template>
    <div themebg-pattern="theme1" id="divRegister">
        <section class="login-block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <form class="md-float-material form-material" @submit.prevent="signup">
                            <div class="text-center">
                                <img src="backend/files/assets/images/logo.png" alt="logo.png">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center txt-primary">Sign up</h3>
                                        </div>
                                    </div>
                                    <!-- <div class="row m-b-20">
                                        <div class="col-md-6">
                                            <a href="#!" class="btn btn-facebook m-b-20 btn-block waves-effect waves-light"><i class="icofont icofont-social-facebook"></i>facebook</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#!" class="btn btn-twitter m-b-0 btn-block waves-effect waves-light"><i class="icofont icofont-social-twitter"></i>twitter</a>
                                        </div>
                                    </div> -->
                                    <p class="text-muted text-center p-b-5">Sign up with your regular account</p>
                                    <div class="form-group form-primary">
                                        <input type="text" class="form-control" v-model="form.name">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Choose Username</label>
                                        <small class="text-danger" v-if="errors.name">*{{ errors.name[0] }} </small>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" class="form-control" v-model="form.email">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Your Email Address</label>
                                        <small class="text-danger" v-if="errors.email">*{{ errors.email[0] }} </small>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-primary">
                                                <input type="password" class="form-control" v-model="form.password">
                                                <span class="form-bar"></span>
                                                <label class="float-label">Password</label>
                                                <small class="text-danger" v-if="errors.password">*{{ errors.password[0] }} </small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-primary">
                                                <input type="password" class="form-control" v-model="form.password_confirmation">
                                                <span class="form-bar"></span>
                                                <label class="float-label">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <!-- <div class="col-md-12">
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">I read and accept <a href="#">Terms &amp; Conditions.</a></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Send me the <a href="#">Newsletter</a> weekly.</span>
                                                </label>
                                            </div>
                                        </div> -->
                                        
                                        <div class="col-md-12">
                                            <div class="forgot-phone text-right float-right">
                                                <router-link to="/" class="text-right f-w-600">Are you Already have an account?</router-link>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign up now</button>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <p class="text-inverse text-left m-b-0">Thank you.</p>
                                            <p class="text-inverse text-left"><a href="#"><b>Back to website</b></a></p>
                                        </div>
                                        <div class="col-md-2">
                                            <img src="backend/files/assets/images/auth/Logo-small-bottom.png" alt="small-logo.png">
                                        </div>
                                    </div>
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
                    name: null,
                    email: null,
                    password: null,
                    password_confirmation: null,
                },
                errors:{}
            }
        },
        methods: {
            signup(){
                axios.post('/api/auth/signup', this.form)
                .then(res =>{
                    User.responseAfterLogin(res)
                    Toast.fire({
                            icon: 'success',
                            title: 'Signed in successfully'
                        })
                    this.$router.push({ name: 'home' })
                })
                .catch(error =>{
                    this.errors = error.response.data.errors;
                })
            }
        }
    } 
</script>

<style scoped>
#divRegister{
    margin-left: -250px;
    margin-top: -60px;
}

@media only screen and (max-width: 600px) {
    #divRegister{
        margin-left: 0px;
        margin-top: -60px;
    }
}
</style>