<template>
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-home bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>All Supplier</h5>
                            <span>Supplier list doesn't contain all information about an supplier.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <router-link to="/home"><i class="feather icon-home"></i></router-link>
                            </li>
                            <li class="breadcrumb-item"><router-link to="/store-supplier">Add Supplier</router-link> </li>
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
                    <!-- Page-body start -->
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5>All Supplier List</h5>
                                        <span>DataTables has most features enabled by default, so all you need to do to use it with your own ables is to call the construction function: $().DataTable();.</span>
                                    </div>                                    
                                    <!-- Search by name -->                             
                                    <div class="row mb-1">
                                        <div class="col-md-9"></div>                                                
                                        <div class="col-md-3">
                                            <input v-model="searchItem" class="form-control" type="text" placeholder="Search by Name.."></input>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">   
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr align="center">
                                                        <th>SL</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>Photo</th>
                                                        <th>Shop</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(supplier,index) in filterItem" :key="supplier.id">
                                                        <td align="center">{{ ++index }}</td>
                                                        <td>{{ supplier.name }}</td>
                                                        <td align="center">{{ supplier.phone }}</td>
                                                        <td>{{ supplier.address }}</td>
                                                        <td align="center"><img :src="supplier.photo" class="img-radius imgSize"></td>
                                                        <td>{{ supplier.shopName }}</td>
                                                        <td align="center">
                                                            <router-link :to="{ name:'edit-supplier', params:{id: supplier.id} }" class="btn btn-sm btn-mat waves-effect waves-light btn-primary">Edit</router-link>
                                                            <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-mat waves-effect waves-light btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                </tbody>                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Zero config.table end -->
                            </div>
                        </div>
                    </div>
                    <!-- Page-body end -->
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
    data(){
        return {
            suppliers:[],
            searchItem: ''
        }
    },
    computed:{
        filterItem(){
            return this.suppliers.filter(supplier => {
                return supplier.name.match(this.searchItem);
            })
        }
    },
    methods:{
        allSuppliers(){
            axios.get('/api/supplier/')
            .then( ({data})=> (this.suppliers = data) )
            .catch()
        },
        deleteSupplier(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/supplier/'+ id)
                    .then(()=> {
                        this.suppliers = this.suppliers.filter(supplier => {
                            return supplier.id != id
                        })
                    })
                    .catch(()=>{
                        this.$router.push({name: 'supplier'})
                    })

                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
        }
    },
    created(){
        this.allSuppliers();
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
    .imgSize{
        width:40px;
        height:40px;
    }
</style>