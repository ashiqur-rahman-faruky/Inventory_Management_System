<template>
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-home bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>All Employee</h5>
                            <span>Employee list doesn't contain all information about an employee.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <router-link to="/home"><i class="feather icon-home"></i></router-link>
                            </li>
                            <li class="breadcrumb-item"><router-link to="/store-employee">Add Employee</router-link> </li>
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
                                        <h5>All Employee List</h5>
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
                                                        <th>Joining Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(employee,index) in filterItem" :key="employee.id">
                                                        <td align="center">{{ ++index }}</td>
                                                        <td>{{ employee.name }}</td>
                                                        <td align="center">{{ employee.phone }}</td>
                                                        <td>{{ employee.address }}</td>
                                                        <td align="center"><img :src="employee.photo" class="img-radius imgSize"></td>
                                                        <td align="center">{{ employee.joining_date }}</td>
                                                        <td align="center">
                                                            <router-link :to="{ name:'edit-employee', params:{id: employee.id} }" class="btn btn-sm btn-mat waves-effect waves-light btn-primary">Edit</router-link>
                                                            <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-mat waves-effect waves-light btn-danger">Delete</a>
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
            employees:[],
            searchItem: ''
        }
    },
    computed:{
        filterItem(){
            return this.employees.filter(employee => {
                return employee.name.match(this.searchItem);
            })
        }
    },
    methods:{
        allEmployees(){
            axios.get('/api/employee/')
            .then( ({data})=> (this.employees = data) )
            .catch()
        },
        deleteEmployee(id){
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
                    axios.delete('/api/employee/'+ id)
                    .then(()=> {
                        this.employees = this.employees.filter(employee => {
                            return employee.id != id
                        })
                    })
                    .catch(()=>{
                        this.$router.push({name: 'employee'})
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
        this.allEmployees();
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