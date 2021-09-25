<template>
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-home bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>All Expense</h5>
                            <span>Expense list doesn't contain all information about expense.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <router-link to="/home"><i class="feather icon-home"></i></router-link>
                            </li>
                            <li class="breadcrumb-item"><router-link to="/store-expense">Add Expense</router-link> </li>
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
                                        <h5>All Expense List</h5>
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
                                                        <th>Expense Details</th>
                                                        <th>Amount</th>
                                                        <th>Expense Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(expense,index) in filterItem" :key="expense.id">
                                                        <td align="center">{{ ++index }}</td>
                                                        <td>{{ expense.details }}</td>
                                                        <td>{{ expense.amount }}</td>
                                                        <td>{{ expense.expense_date }}</td>
                                                        <td align="center">
                                                            <router-link :to="{ name:'edit-expense', params:{id: expense.id} }" class="btn btn-sm btn-mat waves-effect waves-light btn-primary">Edit</router-link>
                                                            <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-mat waves-effect waves-light btn-danger">Delete</a>
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
            expenses:[],
            searchItem: ''
        }
    },
    computed:{
        filterItem(){
            return this.expenses.filter(expense => {
                return expense.details.match(this.searchItem);
            })
        }
    },
    methods:{
        allExpenses(){
            axios.get('/api/expense/')
            .then( ({data})=> (this.expenses = data) )
            .catch()
        },
        deleteExpense(id){
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
                    axios.delete('/api/expense/'+ id)
                    .then(()=> {
                        this.expenses = this.expenses.filter(expense => {
                            return expense.id != id
                        })
                    })
                    .catch(()=>{
                        this.$router.push({name: 'expense'})
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
        this.allExpenses();
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