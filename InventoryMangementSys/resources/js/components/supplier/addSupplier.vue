<template>
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-home bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>Add Supplier</h5>
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
                            <li class="breadcrumb-item"><router-link to="/supplier">All Supplier</router-link> </li>
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
                                        <h5>Supplier Form</h5>
                                        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
                                    </div>
                                    <div class="card-block">
                                        <h4 class="sub-title">Add Supplier</h4>
                                        <form @submit.prevent="supplierInsert" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" v-model="form.name">
                                                            <small class="text-danger" v-if="errors.name">*{{ errors.name[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Address <span class="text-danger">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" v-model="form.address">
                                                            <small class="text-danger" v-if="errors.address">*{{ errors.address[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Phone <span class="text-danger">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" v-model="form.phone">
                                                            <small class="text-danger" v-if="errors.phone">*{{ errors.phone[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="email" class="form-control" v-model="form.email">
                                                            <small class="text-danger" v-if="errors.email">*{{ errors.email[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Shope Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" v-model="form.shopName">
                                                            <small class="text-danger" v-if="errors.shopName">*{{ errors.shopName[0] }} </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Image</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" class="form-control" @change="onFileSelected" id="photo">
                                                            <small class="text-danger" v-if="errors.photo">*{{ errors.photo[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"></label>
                                                        <div class="col-sm-9">
                                                            <img :src="form.photo" alt="user image" height="200px" width="200px" class="img-radius">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light form-control">Submit</button>
                                                </div>
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
                name: null,
                email: null,
                phone: null,
                address: null,
                photo: "backend/images/null.png",
                shopName: null
            },
            errors: []
        }
    },
    methods: {
        onFileSelected(event){
            let file = event.target.files[0];
            if(file.size > 1048770){
                Notification.imageValidated()
                document.querySelector('#photo').value = ''
            }else{
                let reader = new FileReader();
                reader.onload = event=>{
                    this.form.photo = event.target.result
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        supplierInsert(){
            axios.post('/api/supplier', this.form)
            .then( () => {
                this.$router.push({name: 'supplier'})
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