<template>
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-home bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>Update Expense</h5>
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
                            <li class="breadcrumb-item"><router-link to="/expense">All Expense</router-link> </li>
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
                                        <h5>Expense Form</h5>
                                        <span>Update class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
                                    </div>
                                    <div class="card-block">
                                        <h4 class="sub-title">Update Expense</h4>
                                        <form @submit.prevent="expenseUpdate" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Expense Details<span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <textarea rows="5" cols="5" class="form-control" placeholder="Expense Details" v-model="form.details"></textarea>
                                                            <small class="text-danger" v-if="errors.details">*{{ errors.details[0] }} </small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Amount<span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" v-model="form.amount">
                                                            <small class="text-danger" v-if="errors.amount">*{{ errors.amount[0] }} </small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Expense Date</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control" v-model="form.expense_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light form-control">Update</button>
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
                details: null,
                amount: null,
                expense_date: null,
            },
            errors: []
        }
    },
    created(){
        let id = this.$route.params.id;
        axios.get('/api/expense/' + id)
        .then(({data}) => (this.form = data))
        .catch(console.log(error))
    },
    methods: {
        expenseUpdate(){
            let id = this.$route.params.id;
            axios.patch('/api/expense/'+ id, this.form)
            .then( () => {
                this.$router.push({name: 'expense'})
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