<template>
    <div class="h-screen bg-gray-100 w-screen">
        <div className="flex max-w-screen h-screen">
            <aside
                :class="{ 'w-3/4 md:w-80': open, 'w-20': !open }"
                class="bg-blue-500 p-5 pt-8 sticky top-0 duration-300"
            >
                <span
                    @click="open = !open"
                    class="absolute cursor-pointer -right-3 top-16 w-7 shadow-md rounded-full bg-white"
                    :class="{ open: 'rotate-180' }"
                >
                    <i data-feather="chevron-left"> </i>
                </span>
                <div className="flex gap-x-4 items-center justify-center">
                    <img
                        className="cursor-pointer duration-500 w-12 h-12  "
                    />
                </div>
                <div
                    className="flex flex-col justify-between w-full pt-6 text-white"
                >
                    <div v-for="menu in Menus" :key="menu.title">
                        <router-link :to=menu.route>
                            <span>
                            {{ menu.title }}
                            </span>
                        </router-link>
                    </div>
                </div>
            </aside>
            <div>
                <Navbar />
                <div className="bg-gray-200">
                    <router-view />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
const open = ref(true);
const Menus = ref([
    { title: "Dashboard", src: "file-text", route: "/" },
    { title: "Items", src: "mail", gap: true, route: "/credentials" },
    { title: "Groups ", src: "layers", route: "/" },
    { title: "Orders ", src: "list", route: "/dashboard" },
    {
        title: "Editor ",
        src: "file",
        gap: true,
        route: "/dashboard/editor",
    },
]);
</script>

<style>
.router-link-active {
    background-color: #2583ff;
    color: #2d3748;
}
</style>
