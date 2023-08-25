<template>
    <div class="h-screen flex max-w-screen bg-gray-100">
        <aside
            class="bg-[#303690] p-5 pt-8 sticky h-screen top-0 duration-300 w-1/4"
        >
            <div className="flex items-center justify-center ">
                <img
                    className="cursor-pointer duration-500 bg-white h-24"
                    src="https://lionnomb.sirv.com/Terra%20Images/Terra%20Icon%20Pack/TERRA%20PACK-28.svg"
                />
            </div>
            <div
                className="flex flex-col justify-between w-full pt-6 text-white mx-5"
            >
                <div v-for="menu in Menus" :key="menu.title">
                    <router-link
                        :to="menu.route"
                        class="flex rounded-md p-2 cursor-pointer hover:bg-gray-400 text-gray-100 text-sm items-center w-48 m-3"
                    >
                        <v-icon :icon="menu.src" />

                        <a class="px-10 rounded-md">
                            {{ menu.title }}
                        </a>
                    </router-link>
                </div>
            </div>
        </aside>
        <div class="w-3/4 justify-self-end overflow-auto">
            <div class="py-3 bg-gray-200 w-full"><Navbar /></div>
            <router-view />
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Navbar from "../Navbar.vue";

const open = ref(true);
const Menus = ref([
    { title: "Dashboard", src: "mdi-home", route: "/user-dashboard" },
    { title: "Profile", src: "mdi-account", gap: true, route: "/profile" }, 
])

</script>

<style>
.router-link-active {
    background-color: #fff;
    color: #4d4955;
}
</style>
