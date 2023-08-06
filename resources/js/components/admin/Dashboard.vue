<template>
danny
</template>

<script setup>
import { ref } from "vue";
import Navbar from "../Navbar.vue";

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
