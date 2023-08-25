import { createRouter, createWebHistory } from "vue-router";
import login from "../../components/Login.vue";
import Dashboard from "../../components/admin/Dashboard.vue";
import Sidebar from "../../components/Sidebar.vue";
import Credentials from "../../components/admin/Credentials.vue";
import Departments from "../../components/admin/Departments.vue";
import Users from "../../components/admin/Users.vue";
import UserSidebar from "../../components/user/UserSidebar.vue";


const routes = [
    {
        path: "/",
        name: "login",
        component: login,
    },

    {
        path: "/sidebar",
        name: "Sidebar",
        component: Sidebar,
        children: [
            {
                path: "/credentials",
                name: "Credentials",
                component: Credentials,
                meta : {
                    requiresAuth : true,
                    isAdmin : true
                }
            },
            {
                path: "/departments",
                name: "Departments",
                component: Departments,
                meta : {
                    requiresAuth : true,
                    isAdmin : true
                }
            },
            {
                path: "/dashboard",
                name: "Dashboard",
                component: Dashboard,
                meta : {
                    requiresAuth : true,
                    isAdmin : true
                }
            },
            {
                path: "/users",
                name: "Users",
                component: Users,
                meta : {
                    requiresAuth : true,
                    isAdmin : true
                }
            },
            {
                path: "/addNewAdmin",
                name: "AddNewAdmin",
                component: () => import("../admin/AddNewAdmin.vue"),
                meta : {
                    requiresAuth : true,
                    isAdmin : true
                }
            },
        ],
        meta : {
            requiresAuth : true,
            isAdmin : true
        }
    },

    {
        path: "/user-sidebar",
        name: "UserSidebar",
        component:UserSidebar,
        children: [
            {
                path: "/user-dashboard",
                name: "UserDashboard",
                component: () =>
                    import("../user/UserDashboard.vue"),
                    meta : {
                        requiresAuth : true
                    }
            },
            {
                path: "/profile",
                name: "Profile",
                component: () => import("../user/UserProfile.vue"),
                meta : {
                    requiresAuth : true
                }
            }
        ],
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});


router.beforeEach((to, from, next) => { 
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!localStorage.getItem('token')) {
            next('/')
        } 
        else {
            next()
        }
    } 
    else {
        next()
    }

    // if (to.matched.some(record => record.meta.isAdmin)) {
    //     if (localStorage.getItem('role') != 'admin') {
    //         next('/user-sidebar')
    //     } 
    //     else {
    //         next()
    //     }
    // }
 
})

export default router;
