    import { createRouter , createWebHistory } from "vue-router"
    import login from '../../components/Login.vue'


    const routes = [
        {
            path:'/',
            component:login,
            name:'login'

        }
    ]
    const router = createRouter({
        history: createWebHistory(),
        routes
    })
    export default router