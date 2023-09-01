<template>
    <div class="mt-5">
        <v-row class="flex justify-end p-5 mx-1">
            <v-dialog v-model="dialog" persistent width="720">
                <template v-slot:activator="{ props }">
                    <button
                        class="rounded-sm bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md"
                        v-bind="props"
                    >
                        <v-icon icon="mdi-plus"></v-icon> Add New User
                    </button>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="text-h6">Add New User</span>
                    </v-card-title>
                    <hr />
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        label="Full Name"
                                        v-model="name"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-select
                                        :items="departments"
                                        label="Department"
                                        required
                                        v-model="department"
                                        multiple
                                    ></v-select>
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
                            @click="addNewUser"
                        >
                            Save
                        </button>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </div>

    <div class="m-5 bg-white shadow-lg rounded-md p-2">
        <EasyDataTable :headers="headers" :items="items" border-cell>
            <template #item-edit-operation="selectedItem">
                <v-dialog v-model="editDialog" persistent width="720">
                    <template v-slot:activator="{ props }">
                        <div class="flex items-center justify-center">
                            <button
                                class="rounded-full bg-blue-600 py-1 px-4 text-white text-sm shadow-md"
                                @click="showEditModal(selectedItem)"
                                v-bind="props"
                            >
                                edit
                            </button>
                        </div>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="text-h6">Edit User</span>
                        </v-card-title>
                        <hr />
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Full Name"
                                            v-model="name"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-select
                                            :items="[
                                                'Development',
                                                'Sales',
                                                'Finance',
                                            ]"
                                            label="Department"
                                            required
                                            v-model="department"
                                        ></v-select>
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
                                @click="editDialog = false"
                            >
                                Close
                            </button>
                            <button
                                class="rounded-sm bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md ml-4"
                                @click="editUser(selectedItem)"
                            >
                                Save
                            </button>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </template>

            <template #item-delete-operation="selectedItem">
                <div class="operation-wrapper">
                    <button
                        class="rounded-full bg-red-600 py-1 px-4 text-white text-sm shadow-md"
                        @click="showDeleteModal(selectedItem.id)"
                    >
                        delete
                    </button>
                </div>
            </template>
            <template #item-operation="selectedItem">
                <div class="operation-wrapper">
                    {{
                        selectedItem.roles
                            ? selectedItem.roles[0].name
                            : "unassigned department"
                    }}
                </div>
            </template>
        </EasyDataTable>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
export default {
    setup() {
        onMounted(() => {
            getUsers();
            getDepartments();
        });
        const users = ref([]);
        const name = ref("");
        const department = ref("");
        const phoneNumber = ref("");
        const email = ref("");
        const headers = [
            { text: "Name ", value: "name" },
            { text: "Department ", value: "operation" },
            { text: "Email ", value: "email" },
            { text: "Phone Number ", value: "phone_number" },
            { text: "Edit", value: "edit-operation" },
            { text: "Delete", value: "delete-operation" },
        ];

        function addNewUser() {
            axios
                .post(
                    "http://127.0.0.1:8000/api/createUsers",
                    {
                        name: name.value,
                        department: department.value,
                        email: email.value,
                        phone_number: phoneNumber.value,
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
            getUsers();
        }
        function editUser(id) {
            console.log(item.value.id);

            axios
                .post(
                    "http://127.0.0.1:8000/api/editUser",
                    {
                        name: name.value,
                        department: department.value,
                        email: email.value,
                        phone_number: phoneNumber.value,
                        id: item.value.id,
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
                    editDialog.value = false;
                })
                .catch((error) => {
                    console.log(error);
                });
            getUsers();
        }

        function deleteUser(a) {
            axios
                .post(
                    "http://127.0.0.1:8000/api/deleteUser",
                    {
                        id: item.value.id,
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
            getUsers();
        }

        function getDepartments() {
            axios
                .get(
                    "http://127.0.0.1:8000/api/getRoles",

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
                    
                    departments.value = Object.values(
                        response.data.roles
                            .map((item) => item.name)
                            .filter((item) => item !== "admin")
                    );
                    console.log(departments.value);
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
                    users.value = response.data.users;
                    items.value = users.value;
                    console.log(response.data.users);
                });
        }
        const items = ref([]);
        const item = ref({});
        const departments = ref([]);
        function showDeleteModal(selectedItem) {
            item.value = selectedItem;
            deleteDialog.value = true;
            deleteUser(item.value.id);
        }

        function showEditModal(selectedItem) {
            item.value = selectedItem;
            console.log(item.value.id);
            editDialog.value = true;
            name.value = item.value.name;
            department.value = item.value.department;
            phoneNumber.value = item.value.phone_number;
            email.value = item.value.email;
        }
        const dialog = ref(false);
        const editDialog = ref(false);
        const deleteDialog = ref(false);
        return {
            headers,
            items,
            departments,
            dialog,
            addNewUser,
            getUsers,
            name,
            department,
            phoneNumber,
            email,
            users,
            showDeleteModal,
            showEditModal,
            editDialog,
            editUser,
            deleteUser,
            deleteDialog,
            editDialog,
            item,
            getDepartments,
        };
    },
};
</script>
