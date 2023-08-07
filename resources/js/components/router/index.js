import { createRouter, createWebHistory } from "vue-router";
import login from "../../components/Login.vue";
import Dashboard from "../../components/admin/Dashboard.vue";
import Sidebar from "../../components/Sidebar.vue";
import Credentials from "../../components/admin/Credentials.vue";
import Departments from "../../components/admin/Departments.vue";
import Users from "../../components/admin/Users.vue";

const routes = [
    {
        path: "/",
        name: "login",
        component: login,
    },

    {
        path: "/sidebar",
        name: "Sidebar",
        component:Sidebar,
        children: [
            {
                path: "/credentials",
                name: "Credentials",
                component: Credentials,
            },
            {
                path: "/departments",
                name: "Departments",
                component: Departments,
            },
            {
                path: "/dashboard",
                name: "Dashboard",
                component: Dashboard,
            },
            {
                path: "/users",
                name: "Users",
                component: Users,
            },
        ],
    },

];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;
