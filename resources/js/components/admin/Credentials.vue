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
        <EasyDataTable :headers="headers" :items="items" border-cell />
    </div>
</template>

// import { Header, Item } from "vue3-easy-data-table";
<script>
import { ref, onMounted } from "vue";
import { getRoles } from "../api/services";
export default {
    setup() {
        onMounted(async () => {
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

        const headers = [];

        const items = [];
        function addNewCredential() {
            axios
                .post(
                    "http://127.0.0.1:8000/api/createNewCredential",
                    {
                        organization: organization.value,
                        password: password.value,
                        notes: notes.value,
                        department: department.value,
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
        function getCreds() {}
        const dialog = ref(false);
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
        };
    },
};
</script>
