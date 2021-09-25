<template>
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-home bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>Add Product</h5>
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
                            <li class="breadcrumb-item"><router-link to="/product">All Product</router-link> </li>
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
                                        <h5>Product Form</h5>
                                        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
                                    </div>
                                    <div class="card-block">
                                        <h4 class="sub-title">Add product</h4>
                                        <form @submit.prevent="productInsert" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Category <span class="text-danger">*</span></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" v-model="form.category_id">
                                                                <option v-for="category in categories" :value="category.id">{{ category.category_name }}</option>
                                                            </select>
                                                            <small class="text-danger" v-if="errors.category_id">*{{ errors.category_id[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Product Name <span class="text-danger">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" v-model="form.product_name">
                                                            <small class="text-danger" v-if="errors.product_name">*{{ errors.product_name[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Root <span class="text-danger">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" v-model="form.root">
                                                            <small class="text-danger" v-if="errors.root">*{{ errors.root[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Buying Unit Price <span class="text-danger">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="number" class="form-control" v-model="form.buying_price">
                                                            <small class="text-danger" v-if="errors.buying_price">*{{ errors.buying_price[0] }} </small>
                                                        </div>
                                                    </div>     
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Buying Date <span class="text-danger">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control" v-model="form.buying_date">
                                                            <small class="text-danger" v-if="errors.buying_date">*{{ errors.buying_date[0] }} </small>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Supplier <span class="text-danger">*</span></label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" v-model="form.supplier_id">
                                                                <option v-for="supplier in suppliers" :value="supplier.id">{{ supplier.name }}</option>
                                                            </select>
                                                            <small class="text-danger" v-if="errors.supplier_id">*{{ errors.supplier_id[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Product Code <span class="text-danger">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" v-model="form.product_code">
                                                            <small class="text-danger" v-if="errors.product_code">*{{ errors.product_code[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Product Quantity <span class="text-danger">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="number" class="form-control" v-model="form.product_quantity">
                                                            <small class="text-danger" v-if="errors.product_quantity">*{{ errors.product_quantity[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Selling Unit Price <span class="text-danger">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="number" class="form-control" v-model="form.selling_price">
                                                            <small class="text-danger" v-if="errors.selling_price">*{{ errors.selling_price[0] }} </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Image<span class="text-danger">*</span></label>
                                                        <div class="col-sm-6">
                                                            <input type="file" class="form-control" @change="onFileSelected" id="image">
                                                            <small class="text-danger" v-if="errors.image">*{{ errors.image[0] }} </small>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <img :src="form.image" height="40px" width="50px">
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
                category_id: null,
                product_name: null,
                product_code: null,
                root: null,
                buying_price: null,
                selling_price: null,
                supplier_id: null,
                buying_date: null,
                image:null,
                product_quantity: null,
            },
            categories:{},
            suppliers:{},
            errors: []
        }
    },
    methods: {
        onFileSelected(event){
            let file = event.target.files[0];
            if(file.size > 1048770){
                Notification.imageValidated()
                document.querySelector('#image').value = ''
            }else{
                let reader = new FileReader();
                reader.onload = event=>{
                    this.form.image = event.target.result
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        productInsert(){
            axios.post('/api/product', this.form)
            .then( () => {
                this.$router.push({name: 'product'})
                Notification.success()
            })
            .catch(error =>{
                this.errors = error.response.data.errors;
                Notification.Validate()
           })
        }
    },
    created(){
        axios.get('/api/category/')
        .then( ({data})=> (this.categories = data) )
        .catch()

        axios.get('/api/supplier/')
        .then( ({data})=> (this.suppliers = data) )
        .catch()
    }
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