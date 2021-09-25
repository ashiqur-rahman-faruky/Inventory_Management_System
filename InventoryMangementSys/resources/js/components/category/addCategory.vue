<template>
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-home bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>Add Category</h5>
                            <span>The<span class="text-danger"> * </span>marks field must be required.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <router-link to="/home"><i class="feather icon-home"></i></router-link>
                            </li>
                            <li class="breadcrumb-item"><router-link to="/category">All Category</router-link> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- Page body start -->
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Basic Form Inputs card start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Category Form</h5>
                                        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
                                    </div>
                                    <div class="card-block">
                                        <h4 class="sub-title">Add Category</h4>
                                        <form @submit.prevent="categoryInsert" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Category Name <span class="text-danger">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" v-model="form.category_name">
                                                            <small class="text-danger" v-if="errors.category_name">*{{ errors.category_name[0] }} </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light form-control">Submit</button>
                                                </div>
                                                <div class="col-sm-7"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Basic Form Inputs card end -->
                            </div>
                        </div>
                    </div>
                    <!-- Page body end -->
                </div>
            </div>
            <!-- Main-body end -->
            <div id="styleSelector">

            </div>
        </div>
    </div>
</template>
<script>
export default {
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' })
        }
    },
    data() {
        return {
            form : {
                category_name: null,
            },
            errors: []
        }
    },
    methods: {
        categoryInsert(){
            axios.post('/api/category', this.form)
            .then( () => {
                this.$router.push({name: 'category'})
                Notification.success()
            })
            .catch(error =>{
                this.errors = error.response.data.errors;
                Notification.Validate()
           })
        }
    },
}
</script>
<style scoped>
    .pcoded[theme-layout="vertical"][vertical-placement="left"][vertical-nav-type="expanded"][vertical-effect="shrink"] .pcoded-content {
        margin-left: 0;
    }
    .row{
        margin-right: -5px;
    }
</style>