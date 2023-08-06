import { createRouter, createWebHistory } from "vue-router";
import login from "../../components/Login.vue";
import Dashboard from "../../components/admin/Dashboard.vue";
import Sidebar from "../../components/Sidebar.vue";
import Credentials from "../../components/admin/Credentials.vue";
import Departments from "../../components/admin/Departments.vue";

const routes = [
    {
        path: "/",
        name: "login",
        component: login,
    },

    {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
        children: [
            {
                path: "/credentials",
                name: "Credentials",
                component: Credentials,
            },
            {
                path: "/department",
                name: "Department",
                component: Departments,
            },
        ],
    },
    {
        path: "/sidebar",
        name: "Sidebar",
        component: Sidebar,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;
