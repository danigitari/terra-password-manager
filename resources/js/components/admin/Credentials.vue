<template>
    <div class="mt-5">
        <v-row class="flex justify-end p-5 mx-1">
            <v-dialog v-model="dialog" persistent width="720">
                <template v-slot:activator="{ props }">
                    <button
                        class="rounded-sm bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md"
                        v-bind="props"
                    >
                        <v-icon icon="mdi-plus"></v-icon> Add New Credential
                    </button>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="text-h6">Add New Credential</span>
                    </v-card-title>
                    <hr />
                    <v-card-text>
                        <v-container>
                            <v-row>
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
                                        label="Organization"
                                        required
                                        v-model="organization"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        label="Username"
                                        required
                                        v-model="username"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field
                                        label="Password"
                                        required
                                        v-model="password"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" rows="4">
                                    <v-text-field
                                        label="Notes"
                                        required
                                        v-model="notes"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" rows="4">
                                    <v-text-field
                                        label="Other Information"
                                        required
                                        v-model="otherInfo"
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
                            @click="addNewCredential"
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
                            <span class="text-h6">Edit Credential</span>
                        </v-card-title>
                        <hr />
                        <v-card-text>
                            <v-container>
                                <v-row>
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
                                            label="Organization"
                                            required
                                            v-model="organization"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Username"
                                            required
                                            v-model="username"
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Password"
                                            required
                                            v-model="password"
                                            v-text="password"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" rows="4">
                                        <v-text-field
                                            label="Notes"
                                            required
                                            v-model="notes"
                                        ></v-text-field>
                                    </v-col>
                                    <!-- <v-col cols="12" rows="4">
                                        <v-text-field
                                            label="Other Information"
                                            required
                                            v-model="otherInfo"
                                        ></v-text-field>
                                    </v-col> -->
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
                                @click="editCredential"
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
                        @click="showDeleteModal(selectedItem)"
                    >
                        delete
                    </button>
                </div>
            </template>
        </EasyDataTable>
    </div>
</template>

// import { Header, Item } from "vue3-easy-data-table";
<script>
import { ref, onMounted } from "vue";
import { getRoles } from "../api/services";
export default {
    setup() {
        onMounted(async () => {
            getCreds();
            let data = await getRoles();

            departments.value = Object.values(
                data.roles
                    .map((item) => item.name)
                    .filter((item) => item !== "admin")
            );
        });
        const organization = ref("");
        const notes = ref("");
        const password = ref("");
        const department = ref([]);
        const departments = ref([]);
        const username = ref("");
        const otherInfo = ref("");

        const headers = [
            { text: "Username ", value: "username" },
            { text: "Department ", value: "department" },
            { text: "Organization ", value: "organization" },
            { text: "Password", value: "password" },
            { text: "OtherInfo", value: "otherInfo" },
            { text: "Notes", value: "notes" },
            { text: "Edit", value: "edit-operation" },
            { text: "Delete", value: "delete-operation" },
        ];

        const items = ref([]);
        function addNewCredential() {
            axios
                .post(
                    "http://127.0.0.1:8000/api/createNewCredential",
                    {
                        organization: organization.value,
                        password: password.value,
                        notes: notes.value,
                        department: department.value,
                        username: username.value,
                        otherInfo: otherInfo.value,
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
            getCreds();
        }
        function editCredential() {

            axios
                .post(
                    "http://127.0.0.1:8000/api/editCredential",
                    {
                        organization: organization.value,
                        password: password.value,
                        notes: notes.value,
                        department:department.value,
                        username: username.value,
                        otherInfo: otherInfo.value,
                        id:item.value.id
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
            getCreds();
        }
        function getCreds() {
            axios
                .get(
                    "http://127.0.0.1:8000/api/getCredentials",

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
                    items.value = response.data.credentials;
                })
                .catch((error) => {
                    console.log(error);
                });
        }
        const dialog = ref(false);
        const editDialog = ref(false);
        const item = ref({})
        function showEditModal(selectedItem) {
            item.value = selectedItem
            console.log(item.value.id)
            organization.value = item.value.organization    
            password.value =  item.value.password
            notes.value =  item.value.notes
            department.value = item.value.department
            username.value =  item.value.username
           otherInfo.value =  item.value.otherInfo
           console.log(selectedItem)
       
        }

        function showDeleteModal(selectedItem) {
            console.log(selectedItem);
        }
        return {
            headers,
            items,
            dialog,
            addNewCredential,
            organization,
            notes,
            password,
            department,
            departments,
            getCreds,
            username,
            otherInfo,
            editCredential,
            editDialog,
            showEditModal,
            showDeleteModal,
            item
        };
    },
};
</script>
