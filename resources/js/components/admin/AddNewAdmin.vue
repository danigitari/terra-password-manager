<template>
    <div class="mt-5">
        <v-row class="flex justify-end p-5 mx-1">
            <v-dialog v-model="dialog" persistent width="720">
                <template v-slot:activator="{ props }">
                    <button
                        class="rounded-sm bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md"
                        v-bind="props"
                    >
                        <v-icon icon="mdi-plus"></v-icon> Add New Admin
                    </button>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="text-h6">Add New Admin</span>
                    </v-card-title>
                    <hr />
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        label="Full Name"
                                        v-model="name"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        label="Phone Number*"
                                        required
                                        v-model="phoneNumber"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        label="Email*"
                                        required
                                        v-model="email"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions class="m-5">
                        <v-spacer></v-spacer>
                        <button
                            class="rounded-sm bg-red-600 py-2 px-4 text-white text-sm rounded-md shadow-md"
                            @click="dialog = false"
                        >
                            Close
                        </button>
                        <button
                            class="rounded-sm bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md ml-4"
                            @click="addNewAdmin"
                        >
                            Save
                        </button>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </div>
    <div class="m-5 bg-white shadow-lg rounded-md p-2">
        <EasyDataTable :headers="headers" :items="items" border-cell />
    </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
export default {
    setup() {
        const name = ref("");
        const phoneNumber = ref("");
        const email = ref("");
        const headers = [
            { text: "Name ", value: "name" },
            { text: "Email ", value: "email" },
            { text: "Phone Number ", value: "phone_number" },
            { text: "Last Login ", value: "last_login" }

        ];
        function addNewAdmin() {
            axios
                .post(
                    "http://127.0.0.1:8000/api/addNewAdmin",
                    {
                        name: name.value,
                        email: email.value,
                        number: phoneNumber.value,
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
                    dialog.value = false;
                })
                .catch((error) => {
                    console.log(error);
                });
        }

        function getUsers() {
            axios
                .get("http://127.0.0.1:8000/api/getUsers", {
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
                });
        }
        const items = [];
        const dialog = ref(false);
        return {
            headers,
            items,
            dialog,
            addNewAdmin,
            getUsers,
            name,
            phoneNumber,
            email,
        };
    },
};
</script>
