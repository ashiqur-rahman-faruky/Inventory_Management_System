let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forgetpassword = require('./components/auth/forgetpassword.vue').default;
let home = require('./components/home.vue').default;
let logout = require('./components/auth/logout.vue').default;

//employee
let storeEmp = require('./components/employee/addEmployee.vue').default;
let employee = require('./components/employee/allEmployee.vue').default;
let editemployee = require('./components/employee/editEmployee.vue').default;

//supplier
let supplier = require('./components/supplier/allSupplier.vue').default;
let storeSupplier = require('./components/supplier/addSupplier.vue').default;
let editSupplier = require('./components/supplier/editSupplier.vue').default;

//category
let category = require('./components/category/allCategory.vue').default;
let storeCategory = require('./components/category/addCategory.vue').default;
let editCategory = require('./components/category/editCategory.vue').default;

//product
let product = require('./components/product/allProduct.vue').default;
let storeProduct = require('./components/product/addProduct.vue').default;
let editProduct = require('./components/product/editProduct.vue').default;

//expense
let expense = require('./components/expense/allExpense.vue').default;
let storeExpense = require('./components/expense/addExpense.vue').default;
let editExpense = require('./components/expense/editExpense.vue').default;


export const routes = [{
        path: '/',
        component: login,
        name: '/'
    },
    {
        path: '/register',
        component: register,
        name: 'register'
    },
    {
        path: '/forgetpassword',
        component: forgetpassword,
        name: 'forgetpassword'
    },
    {
        path: '/home',
        component: home,
        name: 'home'
    },
    {
        path: '/logout',
        component: logout,
        name: 'logout'
    },
    {
        path: '/employee',
        component: employee,
        name: 'employee'
    },
    {
        path: '/store-employee',
        component: storeEmp,
        name: 'store-employee'
    },
    {
        path: '/edit-employee/:id',
        component: editemployee,
        name: 'edit-employee'
    },
    {
        path: '/supplier',
        component: supplier,
        name: 'supplier'
    },
    {
        path: '/store-supplier',
        component: storeSupplier,
        name: 'store-supplier'
    },
    {
        path: '/edit-supplier/:id',
        component: editSupplier,
        name: 'edit-supplier'
    },
    {
        path: '/category',
        component: category,
        name: 'category'
    },
    {
        path: '/store-category',
        component: storeCategory,
        name: 'store-category'
    },
    {
        path: '/edit-category/:id',
        component: editCategory,
        name: 'edit-category'
    },
    {
        path: '/product',
        component: product,
        name: 'product'
    },
    {
        path: '/store-product',
        component: storeProduct,
        name: 'store-product'
    },
    {
        path: '/edit-product/:id',
        component: editProduct,
        name: 'edit-product'
    },
    {
        path: '/expense',
        component: expense,
        name: 'expense'
    },
    {
        path: '/store-expense',
        component: storeExpense,
        name: 'store-expense'
    },
    {
        path: '/edit-expense/:id',
        component: editExpense,
        name: 'edit-expense'
    }
]