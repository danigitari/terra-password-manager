<template>
    <div class="mt-5">
        <v-row class="flex justify-end p-5 mx-1">
            <v-dialog v-model="dialog" persistent width="720">
                <template v-slot:activator="{ props }">
                    <button
                        class="rounded-sm bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md"
                        v-bind="props"
                    >
                        <v-icon icon="mdi-plus"></v-icon> Add New Department
                    </button>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="text-h6">Add New Department</span>
                    </v-card-title>
                    <hr />
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        label=" Name of Department"
                                        v-model="departments"
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
                            @click="editDepartment"
                        >
                            Save
                        </button>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </div>
    <div class="m-5 bg-white shadow-lg rounded-md p-2">
        <EasyDataTable :headers="headers" :items="newItems" border-cell>
            <template #item-date-operation="selectedItem">
                <div class="operation-wrapper">
        {{  new Date(selectedItem.created_at).toString().slice(0, 24) }}
                </div>
            </template>
            <template #item-edit-operation="selectedItem">
                <div class="operation-wrapper">
                    <button
                        class="rounded-full bg-blue-600 py-1 px-4 text-white text-sm shadow-md"
                        @click="showEditModal(selectedItem)"
                    >
                        edit
                    </button>
                </div>
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

<script>
import { ref, onMounted } from "vue";
export default {
    setup() {
        onMounted(() => {
            getDepartments();
            getUsers();
        });
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
                    let depts = users.value
                        .map((user) => user.department)
                        .filter((value) => value != "0");
                    function getNumOfTimes(arrayOfNums) {
                        let found = {};
                        for (let i = 0; i < arrayOfNums.length; i++) {
                            let keys = arrayOfNums[i].toString();
                            found[keys] = ++found[arrayOfNums[i]] || 1;
                        }

                        return found;
                    }

                    departmentUserCount.value = getNumOfTimes(depts);

                    console.log(depts);
                    console.log(departmentUserCount.value);
                    console.log(
                        "wewe",
                        Object.entries(departmentUserCount.value).map(
                            ([key, value]) => {
                                return { name: key, number_of_users: value };
                            }
                        )
                    );

                    console.log(
                        "Items",
                        items.value.map((item) => item.name)
                    );
                    newItems.value = items.value.map((item) => {
                        Object.entries(departmentUserCount.value).map(
                            ([key, value]) => {
                                if (item.name == key) {
                                    item["number_of_users"] = value;
                                } else {
                                    item["number_of_users"] = 0;
                                }

                                return item;
                            }
                        );

                        for (let i = 0; i < 1; i++) {}

                        return item;
                    });

                    console.log("New ITems", newItems.value);

                    console.log(response.data);
                });
        }
        const headers = [
            { text: "Department ", value: "name" },
            { text: "Number of users ", value: "number_of_users" },
            { text: "Created at ", value: "date-operation" },
            { text: "Edit", value: "edit-operation" },
            { text: "Delete", value: "delete-operation" },
        ];
        const department = ref("");
        const departments = ref("");
        const departmentUserCount = ref("");

        const items = ref([]);
        const newItems = ref([]);
        const users = ref([]);
        const item = ref({});
        const dialog = ref(false);

        function addNewDepartment() {
            axios
                .post(
                    "http://127.0.0.1:8000/api/createNewRole",
                    {
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
                getDepartments();
        }
        function editDepartment() {
            axios
                .post(
                    "http://127.0.0.1:8000/api/editRole",
                    {
                        department: department.value,
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
                    items.value = response.data.roles;
                })
                .catch((error) => {
                    console.log(error);
                });
        }

        function deleteDepartment() {
            console.log(item.value);
        }
        function showEditModal(selectedItem) {
            item.value = selectedItem;
            console.log(id);
        }

        function showDeleteModal(id) {
            item.value = id;
        }

        return {
            headers,
            items,
            dialog,
            addNewDepartment,
            department,
            getDepartments,
            showEditModal,
            showDeleteModal,
            items,
            editDepartment,
            deleteDepartment,
            item,
            departments,
            getUsers,
            departmentUserCount,
            newItems,
        };
    },
};
</script>
