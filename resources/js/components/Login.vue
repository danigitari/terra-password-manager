<template>
    <div
        class="flex flex-col items-center justify-center bg-gray-200 h-[100vh]"
    >
        <a class="flex items-center justify-center w-full mb-0"
            ><img
                src="https://lionnomb.sirv.com/Terra%20Images/Terra%20Icon%20Pack/TERRA%20PACK-28.svg"
                width="65%"
                class="w-64"
            />
        </a>

        <p class="text-red-500 text-xs italic" v-if="error">
            invalid credentials
        </p>

        <div class="w-full max-w-sm">
            <form
                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                @submit.prevent="handleLogin"
            >
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="username"
                    >
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username"
                        type="text"
                        placeholder="Username"
                        v-model="formData.email"
                    />
                </div>
                <div class="mb-6">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="password"
                    >
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password"
                        type="password"
                        placeholder="password"
                        v-model="formData.password"
                    />
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Sign In
                    </button>

                    <a
                        class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                        href="#"
                    >
                        Forgot Password?
                    </a>
                </div>
            </form>
            <p class="text-center text-gray-500 text-xs">
                &copy;2023 Terra Softworks. All rights reserved.
            </p>
        </div>
    </div>
</template>
<script>
import { reactive, ref } from "vue";
import { login } from "./api/services.js";

import { useRouter } from "vue-router";
export default {
    name: "Login",

    setup() {
        const router = useRouter();
        const formData = reactive({
            email: "",
            password: "",
        });
        const error = ref(false);
        const handleLogin = async () => {
            const res = await login(formData);
            if(res.response){
            if (res.response.status === 401) {
                error.value = true;
            }}
            if (!res.data.role) {
                error.value = true;
                router.push("/");
            }

            if (res.status === 200) {
                if (res.data.role === "admin") {
                    localStorage.setItem("token", res.data.token);
                    router.push("/dashboard");
                }
                else {
                    localStorage.setItem("token", res.data.token);
                    router.push("/user-dashboard");
                }
            }

        };

        return {
            formData,
            handleLogin,
            error
        };
    },
};
</script>
