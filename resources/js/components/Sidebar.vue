<template>
    <div class="h-screen bg-gray-100 w-screen">
        <div className="flex max-w-screen h-screen">
            <aside
                :class="{ 'w-3/4 md:w-80': open, 'w-20': !open }"
                class="bg-[#303690] p-5 pt-8 sticky top-0 duration-300"
            >
                <span
                    @click="open = !open"
                    class="absolute cursor-pointer -right-3 top-16 w-7 shadow-md rounded-full bg-white"
                    :class="{ open: 'rotate-180' }"
                >
                    <i data-feather="chevron-left"> </i>
                </span>
                <div className="flex items-center justify-center ">
                    <img
                        className="cursor-pointer duration-500 w- bg-white h-24"
                        src="https://lionnomb.sirv.com/Terra%20Images/Terra%20Icon%20Pack/TERRA%20PACK-28.svg"
                    />
                </div>
                <div
                    className="flex flex-col justify-between w-full pt-6 text-white mx-10"
                >
                    <div v-for="menu in Menus" :key="menu.title">
                        <router-link
                            :to="menu.route"
                            class="flex rounded-md p-2 cursor-pointer hover:bg-gray-400 text-gray-100 text-sm items-center w-48 m-3"
                        >
                            <v-icon :icon="menu.src" class="text-white" />

                            <a class="px-10 rounded-md">
                                {{ menu.title }}
                            </a>
                        </router-link>
                    </div>
                </div>
            </aside>
            <div class="w-full">
                <div class="px-10 py-3 bg-gray-200"><Navbar /></div>

                <div className="">
                    <router-view />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Navbar from "./Navbar.vue";

const open = ref(true);
const Menus = ref([
    { title: "Dashboard", src: "mdi-home", route: "/department" },
    { title: "Items", src: "mdi-home", gap: true, route: "/credentials" },
    { title: "Groups ", src: "mdi-home", route: "/dashboard " },
    { title: "Orders ", src: "mdi-home", route: "/" },
]);
</script>

<style>
.router-link-active {
    background-color: #2583ff;
    color: #2d3748;
}
</style>
