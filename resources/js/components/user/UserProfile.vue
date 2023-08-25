<template>
    <div class="shadow-md m-5 rounded-md w-3/4 bg-white p-5">
        <div class="flex justify-between">
            <h1 class="text-lg font-bold mb-5">User Profile</h1>
        </div>
        <div class="flex justify-between flex-col gap-y-4">
            <div class="flex flex-col">
                <span class="text-md text-gray-400">Full Name</span>
                <input
                    class="shadow appearance-none border bg-gray-200 rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username"
                    type="text"
                    v-model="user.name"
                />
            </div>

            <div class="flex flex-col">
                <span class="text-md text-gray-400">Phone Number</span>
                <input
                    class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-black leading-tight bg-gray-200 focus:outline-none focus:shadow-outline"
                    id="username"
                    type="text"
                    autocomplete="off"
                    v-model="user.phone_number"
                />
            </div>
            <div class="flex flex-col">
                <span class="text-md text-gray-400">Email</span> 
                <input
                    class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-black leading-tight bg-gray-200 focus:outline-none focus:shadow-outline"
                    id="username"
                    type="text"
                    placeholder="email"
                    v-model="user.email"
                    autocomplete="off"
                />
            </div>
            <div class="flex flex-col">
                <span class="text-md text-gray-400">Password</span>
                <input
                    class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-black leading-tight bg-gray-200 focus:outline-none focus:shadow-outline"
                    id="username"
                    type="password"
                    placeholder="password"
                    v-model="user.password"
                    autocomplete="off"
                />
            </div>
        </div>
        <div class="flex justify-end w-full">
            <button
                class="rounded-sm bg-[#303690] py-2 px-4 m-5 text-white text-sm rounded-md shadow-md"
           @click="editProfile" >
                Edit Profile
            </button>
        </div>
        <span class="flex justify-end text-xs text-red-400">
            NB: only phone number and password can be changed</span
        >
    </div>
</template>
<script>
import axios from "axios";
import { onMounted, ref } from "vue";

export default {
    setup() {
        onMounted(() => {
            getCurrentUser();
        });

        const user = ref({});
        function getCurrentUser() {
            axios
                .get("http://127.0.0.1:8000/api/getCurrentUser", {
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
                    user.value = response.data.user;
                })
                .catch((error) => {
                    console.log(error);
                });
        }
        function editProfile(){
            axios
                .post(
                    "http://127.0.0.1:8000/api/editProfile",
                    {
                        email: user.email,
                        password: user.password,
                        number: user.phone_number,
                    },
                    {
                        headers: {
                            Accept: "application/json",
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            Authorization:
                                "Bearer " + localStorage.getItem("token"),
                        },
                    }
                )
                .then((response) => {
                    console.log(response.data);
                 
                })
                .catch((error) => {
                    console.log(error);
                });
        

        }

        return {
            getCurrentUser,
            user,
            editProfile
        };
    },
};
</script>
