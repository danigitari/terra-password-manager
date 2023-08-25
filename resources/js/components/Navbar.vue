<template>
    <nav class="flex justify-between items-center px-10">
        <div>Dashboard</div>
        <div class="flex gap-x-8">
            <v-text-field
                density="compact"
                variant="solo"
                label="Search "
                append-inner-icon="mdi-magnify"
                single-line
                hide-details
                class="w-56"
            ></v-text-field>

            <v-menu transition="slide-y-transition">
                <template v-slot:activator="{ props }">
                    <v-avatar v-bind="props">
                        <v-img
                            src="https://cdn.vuetifyjs.com/images/john.jpg"
                            alt="John"
                        ></v-img>
                    </v-avatar>
                </template>
                <v-list class="w-48">
                    <v-list-item class="border-b-[1px] border-gray-900 text-sm">
                        <button @click="logout">
                            <v-list-item-title>
                                <v-icon icon="mdi-plus" class="px-3"></v-icon>
                                Logout
                            </v-list-item-title>
                        </button>
                    </v-list-item>
                    <hr />
                    <v-list-item>
                        <v-list-item-title>
                            <v-icon icon="mdi-account"></v-icon>
                            Profile</v-list-item-title
                        >
                    </v-list-item>
                </v-list>
            </v-menu>
        </div>
    </nav>
</template>
<script>
import { useRouter } from "vue-router";

export default {
    setup() {
        const router = useRouter();
        const logout = () => {
            axios
                .post("http://127.0.0.1:8000/api/logout", {
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then((response) => {
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });

            localStorage.removeItem("token");
            router.push("/");
        };

        return { logout, router };
    },
};
</script>
